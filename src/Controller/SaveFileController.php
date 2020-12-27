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
     * @Route("/save/upload", name="save_file")
     */
    public function new(Request $request): Response
    {
        $saveFile = new SaveFile();

        $form = $this->createForm(SaveFileType::class, $saveFile);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameInfoFile = $form->get("game_info_file")->getData();
            $newFilename = 'SaveGameInfo.'.uniqid().'.xml';

            try {
                $gameInfoFile->move($this->getParameter("gamefiles_directory"), $newFilename);

                $worldData = $this->getWorldData($newFilename);

                $saveFile->setWorldData($worldData);
            } catch (FileException $e) {
                // TODO: handle file exceptions
            }

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
