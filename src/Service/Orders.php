<?php

namespace App\Service;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\OrderItems;
use App\Service\SessionStore;
use App\Repository\QuoteOrderRepository;
use App\Entity\QuoteOrder;

class Orders{

    private $entityManager;
    
    private $orderItems;

    private $sessionStore;

    private $quoteOrderRepo;

    private const CATEGORY_NAME = 'Children';

    private const CATEGORY_DISCOUNT = 0.1;

    public function __construct(EntityManagerInterface $entityManager,OrderItems $orderItems ,SessionStore $sessionStore , QuoteOrderRepository $quoteOrderRepo)
    {
        $this->entityManager = $entityManager;
        $this->orderItems = $orderItems;
        $this->sessionStore = $sessionStore;
        $this->quoteOrderRepo = $quoteOrderRepo;
    }

    /**
     * Add new row to Order_item
     */
    public function addOrderRow($id,$book,$qty)
    {
        if ($this->sessionStore->isSessionExist())
        {
            $orderSessionId = $this->sessionStore->getSession();
            $quoteOrder = $this->entityManager->getRepository(QuoteOrder::class)->findOneByOrderId($orderSessionId);
            $quoteOrder->setOrderTotal($quoteOrder->getOrderTotal() + ($book->getPrice() * $qty));
            $quoteOrder->setOrderQty($quoteOrder->getOrderQty() + $qty);

            $this->entityManager->flush();

            $result = $this->orderItems->updateOrderItem($id,$quoteOrder->getId(),$qty,$book);

            if(!$result)
            {
                $this->orderItems->addOrderItemRow($orderSessionId,$book,$quoteOrder,$qty);
            }

        }       
        
        if (!$this->sessionStore->isSessionExist())
        {
            $this->sessionStore->setSession('BS'.rand());
            $orderSessionId = $this->sessionStore->getSession();

            $quoteOrder = new QuoteOrder();
            $quoteOrder->setOrderSessionId($orderSessionId);
            $quoteOrder->setOrderTotal($book->getPrice()* $qty);
            $quoteOrder->setOrderQty($qty);

            $this->entityManager->persist($quoteOrder);
            $this->entityManager->flush();

            $this->orderItems->addOrderItemRow($orderSessionId,$book,$quoteOrder,$qty);            
        }    
    }

    /**
     * Get order total to display cart value
     */
    public function getMiniCartAmount()
    {
        if ($this->sessionStore->isSessionExist())
        {
            $orderSessionId = $this->sessionStore->getSession();
            $quoteOrder = $this->entityManager->getRepository(QuoteOrder::class)->findOneByOrderId($orderSessionId);
            return $quoteOrder->getOrderTotal(); 
        }
        
        return 0.00;        
    }
    
    /**
     * Get all the added items to disply in cart page
     */
    public function showOrderItems()
    {
        if ($this->sessionStore->isSessionExist())
        {
            $orderSessionId = $this->sessionStore->getSession();
            $quoteOrder = $this->entityManager->getRepository(QuoteOrder::class)->findOneByOrderId($orderSessionId);
            return $this->orderItems->getOrderItemsById($quoteOrder->getId());
        }

        //return "Shopping Cart Is empty";
    }

    /**
     * removes items from the cart
     */
    public function updateOrder($bookId,$qty,$subtotal)
    {
        if ($this->sessionStore->isSessionExist())
        {
            $orderSessionId = $this->sessionStore->getSession();
            $quoteOrder = $this->entityManager->getRepository(QuoteOrder::class)->findOneByOrderId($orderSessionId);
            $quoteOrder->setOrderTotal($quoteOrder->getOrderTotal() - $subtotal);
            $quoteOrder->setOrderQty($quoteOrder->getOrderQty() - $qty);

            $this->entityManager->flush();

            return $this->orderItems->removeOrderItem($bookId,$qty,$quoteOrder->getId(),$subtotal);
        }
    }

    /**
     * Calculate all the discounts in checkout page related to added items
     */
    public function calculateTotalDiscounts()
    {
        if ($this->sessionStore->isSessionExist())
        {
            
            $orderSessionId = $this->sessionStore->getSession();
            $quoteOrder = $this->entityManager->getRepository(QuoteOrder::class)->findOneByOrderId($orderSessionId);
            $purchasedBooks = $this->orderItems->getOrderItemsById($quoteOrder->getId());
            return $this->calculateCategoryDiscount($purchasedBooks);


        }
    }

    /**
     * Calculate children category discount
     */
    private function calculateCategoryDiscount($purchasedBooks)
    {
        $totalChildrenBooksCount = 0;
        $totalChildrenBooksAmount = 0;
        $childrenBooksDiscount = 0;

        $categoryItemCount = [];
        $categoryLevelDiscount = 0;
        foreach($purchasedBooks as $book)
        {
            if($book->getBookId()->getBooksCategory()->getCategoryName() == self::CATEGORY_NAME)
            {
                $totalChildrenBooksCount += $book->getQty();
                $totalChildrenBooksAmount += $book->getPrice();
            }
            if($book->getBookId()->getBooksCategory()->getCategoryName() != self::CATEGORY_NAME)
            {
                if(!array_key_exists($book->getBookId()->getBooksCategory()->getId(), $categoryItemCount))
                    $categoryItemCount[$book->getBookId()->getBooksCategory()->getId()] = $book->getQty();

                else $categoryItemCount[$book->getBookId()->getBooksCategory()->getId()] = $book->getQty() + $categoryItemCount[$book->getBookId()->getBooksCategory()->getId()];
            
            }
        }

        foreach ($categoryItemCount as $key => $value)
        {
            if ($value >= 10 )
                $categoryLevelDiscount = 0.05;
            else {
                $categoryLevelDiscount = 0;
                break;
            }

        }

        if ($totalChildrenBooksCount >= 5)
        {
            $childrenBooksDiscount = $totalChildrenBooksAmount * self::CATEGORY_DISCOUNT;
        }

        $total = $this->getOrderTotal($childrenBooksDiscount,$categoryLevelDiscount);


        return array('children_category_discount'=>
                array('name'=>'Discount on Children Books',
                      'value'=>$childrenBooksDiscount),
                'category_level_discount'=>
                    array('name'=>'Discount on Category',
                          'value'=>$categoryLevelDiscount),
                'total_amount'=>
                    array('name'=>'Total Amount',
                          'value'=>$total));
    }

    /**
     * Get order total by after getting discounts
     */
    private function getOrderTotal($childrenBooksDiscount,$categoryLevelDiscount)
    {
        $subTotal = $this->getMiniCartAmount();
        $totalAmount= $subTotal;
        
        if($childrenBooksDiscount != 0)
            $totalAmount = $subTotal - $childrenBooksDiscount;
        if($categoryLevelDiscount)
        {
            $discountAmount = $totalAmount * 0.05;
            $totalAmount = $totalAmount - $discountAmount;
        }
         return $totalAmount;   
    }

    /**
     * Calculate order value for promo code
     */
    public function addPromoCode($promoCode)
    {
        $promoCode = '15';//get value from db
        $subTotal = $this->getMiniCartAmount();
        return $subTotal *15 /100;
    }

}