<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\SaveFile;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="root")
     */
    public function index(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $SAVE_PER_PAGE = 5;

        $saveFilesRepository = $em->getRepository(SaveFile::class);

        $allSavesQuery = $saveFilesRepository->createQueryBuilder('save')
            ->orderBy("save.createdAt", "DESC")
            ->getQuery();

        $saveFiles = $paginator->paginate($allSavesQuery, $request->query->getInt('page', 1), $SAVE_PER_PAGE);

        return $this->render("index.html.twig", [
            "saveFiles" => $saveFiles,
        ]);
    }
}
