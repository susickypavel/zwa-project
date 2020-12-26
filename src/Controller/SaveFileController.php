<?php

namespace App\Controller;

use App\Entity\SaveFile;
use App\Form\SaveFileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            $originalFilename = pathinfo($gameInfoFile->getClientOriginalName(), PATHINFO_FILENAME);
            // TODO: slugger

            // TODO: maybe change originalFilename to generic "GameInfoFile"
            $newFilename = $originalFilename.'.'.uniqid().'.xml';

            try {
                $gameInfoFile->move($this->getParameter("gamefiles_directory"), $newFilename);
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
}
