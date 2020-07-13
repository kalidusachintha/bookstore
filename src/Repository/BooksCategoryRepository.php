<?php

namespace App\Repository;

use App\Entity\BooksCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BooksCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method BooksCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method BooksCategory[]    findAll()
 * @method BooksCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BooksCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BooksCategory::class);
    }

    // /**
    //  * @return BooksCategory[] Returns an array of BooksCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BooksCategory
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
