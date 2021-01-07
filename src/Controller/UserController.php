<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/themechange")
     */
    public function index(Request $request): Response
    {
        $theme = $request->query->get("theme");

        $session = new Session(new NativeSessionStorage(), new AttributeBag());
        $session->set("theme", $theme);

        return $this->redirectToRoute("root");
    }
}
