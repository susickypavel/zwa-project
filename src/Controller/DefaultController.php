<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\SaveFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="root")
     */
    public function index(): Response
    {
        $saveFiles = $this->getDoctrine()->getRepository(SaveFile::class)->findAll();

        return $this->render("index.html.twig", [
            "saveFiles" => $saveFiles
        ]);
    }
}
