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
            $saveFile = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($saveFile);
            $em->flush();

            // TODO: fix me
            return $this->redirectToRoute("/");
        }

        return $this->render('save_file/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
