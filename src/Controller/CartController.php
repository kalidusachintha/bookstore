<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SessionStore;
use App\Service\Orders;
use App\Service\OrderItems;
use App\Entity\Books;
use App\Entity\QuoteOrderItem;
use App\Form\AddPromoCodeType;

class CartController extends AbstractController
{
    
    /**
     * @Route("/cart", name="cart")
     */
    public function index(Orders $orders)
    {        
        return $this->render('cart/cart_items.html.twig', [
            'all_order_items' => $orders->showOrderItems(),
            'subtotal'=> $orders->getMiniCartAmount()            
        ]);
    }

    /**
     * @Route("/cart/remove/item/{bookid}/{qty}/{subtotal}", name="cart.remove.item")
     */
    public function removeItemsFromCart($bookid,$qty,$subtotal,Orders $orders)
    {
        $orders->updateOrder($bookid,$qty,$subtotal);
        $this->addFlash(
            'notice',
            'Item was Removed!'
        );
        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function placeOrder(Orders $orders,Request $request)
    {
        $form = $this->get('form.factory')->createNamed('add_promo', AddPromoCodeType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ) {
            $disount = $orders->addPromoCode($form->get('code')->getData());

            $this->addFlash(
                'notice',
                'You Added Promo Code!'
            );
            return $this->render('cart/place_order.html.twig', [
                'all_order_items' => $orders->showOrderItems(),
                'subtotal'=> $orders->getMiniCartAmount(),
                'discounts' => array('promo'=>array('name'=> 'Promo Code','value'=>$disount),'total_amount'=>array('name'=>'Total Amount','value'=> $orders->getMiniCartAmount() - $disount)),
                'form' => $form->createView(),
    
            ]);
        }

        return $this->render('cart/place_order.html.twig', [
            'all_order_items' => $orders->showOrderItems(),
            'subtotal'=> $orders->getMiniCartAmount(),
            'discounts' => $orders->calculateTotalDiscounts(),
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/cart/remove", name="cart.remove")
     */
    public function removeItem(SessionStore $sessionStore)
    {
        $sessionStore->removeSession();  
    }
}
