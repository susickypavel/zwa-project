<?php

namespace App\Repository;

use App\Entity\WorldUpload;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorldUpload|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorldUpload|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorldUpload[]    findAll()
 * @method WorldUpload[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorldUploadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorldUpload::class);
    }

    // /**
    //  * @return WorldUpload[] Returns an array of WorldUpload objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorldUpload
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
