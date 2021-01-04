<?php

namespace App\Controller;

use App\Entity\WorldUpload;
use App\Form\WorldUploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorldUploadController extends AbstractController
{
    /**
     * @Route("/world/delete", name="world_delete")
     */
    public function delete(Request $request): Response {
        $token = $request->request->get("token");
        $worldUploadId = $request->request->get("worldUploadId");

        $csrfTokenId = "delete-world-".$worldUploadId;

        if (!$this->isGranted("ROLE_ADMIN") || !$this->isCsrfTokenValid($csrfTokenId, $token)) {
            return $this->redirectToRoute("root");
        }

        $em = $this->getDoctrine()->getManager();
        $save = $em->getRepository(WorldUpload::class)->find($worldUploadId);

        if (!$save) {
            return $this->redirectToRoute("root");
        }

        $em->remove($save);
        $em->flush();

        return $this->redirectToRoute("root");
    }

    /**
     * @Route("/world/upload", name="world_upload")
     */
    public function index(Request $request): Response
    {
        $worldUpload = new WorldUpload();

        $uploadForm = $this->createForm(WorldUploadType::class, $worldUpload);
        $uploadForm->handleRequest($request);

        if ($uploadForm->isSubmitted() && $uploadForm->isValid()) {
            $saveGameInfo = $uploadForm["saveGameInfo"]->getData();
            $worldState = $uploadForm["worldState"]->getData();

            $worldData = $this->parseSave($saveGameInfo, $worldState);

            if (!$worldData) {
                return $this->render('world_upload/index.html.twig', [
                    "form" => $uploadForm->createView(),
                    "error" => "Neplatné soubory"
                ]);
            }

            $worldUpload->setWorldData($worldData);
            /** @noinspection PhpParamsInspection */
            $worldUpload->setAuthor($this->getUser());

            try {
                $hash = uniqid();
                $originalFilename = pathinfo($worldState->getClientOriginalName(), PATHINFO_FILENAME);

                $newSaveGameInfo = "SaveGameInfo_".$hash;
                $newWorldState = $originalFilename."_".$hash;

                $worldUpload->setSaveGameInfo($newSaveGameInfo);
                $worldUpload->setWorldState($newWorldState);

                $saveGameInfo->move($this->getParameter("saves"), $newSaveGameInfo);
                $worldState->move($this->getParameter("saves"), $newWorldState);
            } catch (\Exception $error) {
                return $this->render('world_upload/index.html.twig', [
                    "form" => $uploadForm->createView(),
                    "error" => "Stala se chyba při ukládání, zkuste to znovu"
                ]);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($worldUpload);
            $em->flush();

            return $this->redirectToRoute("root");
        }

        return $this->render('world_upload/index.html.twig', [
            "form" => $uploadForm->createView(),
            "error" => null,
        ]);
    }

    private function parseSave(File $saveGameInfo, File $worldState) {
        $crawler = new Crawler($saveGameInfo->getContent());

        try {
            return array(
                "player_name" => $crawler->filter("name")->text(),
                "money" => $crawler->filter("money")->text(),
            );
        } catch (\Exception $error) {
            return null;
        }
    }
}
