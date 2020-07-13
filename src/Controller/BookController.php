<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Books;
use App\Form\AddItemToCartType;
use App\Service\Orders;


class BookController extends AbstractController
{
    /**
     * @Route("/book/{id}", name="book.show")
     */
    public function showBook($id,Request $request,Orders $order)
    {
        $form = $this->get('form.factory')->createNamed('add_to_cart', AddItemToCartType::class);
        $book = $this->getDoctrine()->getRepository(Books::class)->findOneById($id);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ) {
            dump($book);
            $order->addOrderRow($id,$book,$form->get('qty')->getData());
            $this->addFlash(
                'notice',
                'You Added One Item to Cart!'
            );
            return $this->redirectToRoute('main');
        }

        return $this->render('book/_display_book.html.twig', [
            'form' => $form->createView(),
            'book'=> $book
        ]);
    }
}
