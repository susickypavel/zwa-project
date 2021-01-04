<?php

namespace App\Controller;

use App\Entity\WorldUpload;
use App\Repository\WorldUploadRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RootController extends AbstractController
{
    /**
     * @Route("/", name="root")
     */
    public function index(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $rp = $em->getRepository(WorldUpload::class);

        $query = $rp->createQueryBuilder("worldUpload")
            ->orderBy("worldUpload.createdAt", "DESC")
            ->getQuery();

        $worldUploads = $paginator->paginate($query, $request->query->getInt("page", 1), 5);

        return $this->render('index.html.twig', [
            "worldUploads" => $worldUploads
        ]);
    }
}
