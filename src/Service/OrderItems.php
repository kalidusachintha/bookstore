<?php

namespace App\Service;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\QuoteOrderItem;
use App\Entity\Books;

class OrderItems{

    private $entityManager;

    private $sessionStore;

    public function __construct(EntityManagerInterface $entityManager,SessionStore $sessionStore)
    {
        $this->entityManager = $entityManager;
        $this->sessionStore = $sessionStore;
    }

    /**
     * Add new row to quote_order_item
     */
    public function addOrderItemRow($orderId,$book,$quoteOrder,$qty)
    {
        $quoteOrderItem = new QuoteOrderItem();
        $quoteOrderItem->setQuoteOrderId($quoteOrder);
        $quoteOrderItem->setBookId($book);
        $quoteOrderItem->setQty($qty);
        $quoteOrderItem->setPrice($book->getPrice() * $qty);

        $this->entityManager->persist($quoteOrderItem);
        $this->entityManager->flush();
    }

    /**
     * Update quote_order_item
     */
    public function updateOrderItem($productId,$quoteId,$qty,$book)
    {
        $quoteOrderItem = $this->entityManager->getRepository(QuoteOrderItem::class)->findOneById($productId,$quoteId);
        if($quoteOrderItem)
        {
            $quoteOrderItem->setPrice(($book->getPrice()) * ($quoteOrderItem->getQty() + $qty));
            $quoteOrderItem->setQty($quoteOrderItem->getQty() + $qty);            

            $this->entityManager->flush();
            return true;
        }

        return false;
        
    }

    /**
     * Get order items by order_id
     */
    public function getOrderItemsById($orderSessionId)
    {
        return $this->entityManager->getRepository(QuoteOrderItem::class)->findByQuoteOrderId($orderSessionId);
    }

    /**
     * Remove items from table
     */
    public function removeOrderItem($bookId,$qty,$quoteOrderId,$subtotal)
    {
        $quoteOrderItem = $this->entityManager->getRepository(QuoteOrderItem::class)->findOneById($bookId,$quoteOrderId);
        if($quoteOrderItem)
        {
            $this->entityManager->remove($quoteOrderItem);
            $this->entityManager->flush();
            return true;
        }

        return false;
        
    }
}