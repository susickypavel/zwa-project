<?php
// src/Controller/LuckyController.php
namespace App\Controller;

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
        $my_variable = "Pavel Susicky made this project";

        return $this->render("base.html.twig", [
            "my_variable" => $my_variable
        ]);
    }
}
