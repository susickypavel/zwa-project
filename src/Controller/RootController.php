<?php

namespace App\Controller;

use App\Entity\WorldUpload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RootController extends AbstractController
{
    /**
     * @Route("/", name="root")
     */
    public function index(): Response
    {
        $worldUploads = $this->getDoctrine()->getRepository(WorldUpload::class)->findAll();

        return $this->render('index.html.twig', [
            "worldUploads" => $worldUploads
        ]);
    }
}
