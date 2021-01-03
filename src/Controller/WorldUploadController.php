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
                // TODO: Save paths to files to database
                $hash = uniqid();
                $originalFilename = pathinfo($worldState->getClientOriginalName(), PATHINFO_FILENAME);

                $saveGameInfo->move($this->getParameter("saves"), "SaveGameInfo_".$hash);
                $worldState->move($this->getParameter("saves"), $originalFilename."_".$hash);
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
