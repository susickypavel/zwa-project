<?php

namespace App\Repository;

use App\Entity\SaveFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SaveFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaveFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaveFile[]    findAll()
 * @method SaveFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaveFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaveFile::class);
    }

    // /**
    //  * @return SaveFile[] Returns an array of SaveFile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SaveFile
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
