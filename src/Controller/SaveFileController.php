<?php

namespace App\Controller;

use App\Entity\SaveFile;
use App\Form\SaveFileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SaveFileController extends AbstractController
{
    /**
     * @Route("/upload", name="save_file")
     */
    public function new(Request $request): Response
    {
        $saveFile = new SaveFile();

        $form = $this->createForm(SaveFileType::class, $saveFile);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameInfoFile = $form->get("game_info_file")->getData();
            $newFilename = 'SaveGameInfo.'.uniqid().'.xml';

            // TODO: handle exceptions
            $gameInfoFile->move($this->getParameter("gamefiles_directory"), $newFilename);

            $worldData = $this->getWorldData($newFilename);

            /** @noinspection PhpParamsInspection */
            $saveFile->setAuthor($this->getUser());
            $saveFile->setWorldData($worldData);
            $saveFile->setGameInfoFile($newFilename);

            $saveFile = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($saveFile);
            $em->flush();

            return $this->redirectToRoute("root");
        }

        return $this->render('save_file/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/upload/delete", name="delete_save")
     */
    public function deleteSave(Request $request): Response {
        $token = $request->request->get("token");

        if (!$this->isGranted("ROLE_ADMIN") || !$this->isCsrfTokenValid("delete-save", $token)) {
            return $this->redirectToRoute("root");
        }

        $saveId = $request->request->get("saveId");

        $em = $this->getDoctrine()->getManager();
        $save = $em->getRepository(SaveFile::class)->find($saveId);

        if (!$save) {
            return $this->redirectToRoute("root");
        }

        $em->remove($save);
        $em->flush();

        return $this->redirectToRoute("root");
    }

    private function getWorldData(string $file) {
        $pathToSaveFile = $this->getParameter("gamefiles_directory").'/'.$file;

        // TODO: handle exception
        $crawler = new Crawler(file_get_contents($pathToSaveFile));

        $name = $crawler->filter("name")->text();
        $money = $crawler->filter("money")->text();

        $worldData = array("name" => $name, "money" => $money);

        return $worldData;
    }
}
