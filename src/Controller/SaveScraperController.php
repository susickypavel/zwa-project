<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelector;
use Symfony\Component\Routing\Annotation\Route;

class SaveScraperController extends AbstractController
{
    /**
     * @Route("/save/scraper", name="save_scraper")
     */
    public function index(): Response
    {
        $projectDir = $this->getParameter('kernel.project_dir');

        $crawler = new Crawler(file_get_contents($projectDir . '/public/' . "test"));

        $name = $crawler->filter("name")->text();
        $stamina = $crawler->filter("stamina")->text();
        $speed = $crawler->filter("speed")->text();
        $money = $crawler->filter("money")->text();

        return $this->render('save_scraper/form.html.twig', [
            'name' => $name,
            'stamina' => $stamina,
            'money' => $money,
            'speed' => $speed,
        ]);
    }
}
