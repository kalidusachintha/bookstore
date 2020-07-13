<?php

namespace App\Repository;

use App\Entity\QuoteOrderItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuoteOrderItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuoteOrderItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuoteOrderItem[]    findAll()
 * @method QuoteOrderItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoteOrderItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuoteOrderItem::class);
    }

    // /**
    //  * @return QuoteOrderItem[] Returns an array of QuoteOrderItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuoteOrderItem
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByQuoteOrderId($quoteOrderId)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.quote_order_id = :val')
            ->setParameter('val', $quoteOrderId)
            ->orderBy('q.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findOneById($productId,$quoteId): ?QuoteOrderItem
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.book_id = :proid')
            ->andWhere('q.quote_order_id = :quoteid')
            ->setParameter('proid', $productId)
            ->setParameter('quoteid', $quoteId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
