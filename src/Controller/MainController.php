<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\BooksCategory;
use App\Entity\Books;
use App\Form\AddItemToCartType;
use App\Service\Orders;

class MainController extends AbstractController
{
    
    public function index(Request $request , Orders $order)
    {
        return $this->render('main/_navigation.html.twig', [
            'categories' => $this->getCategories(),
            'minicartvalue'=> $order->getMiniCartAmount()
        ]);
    }
    /**
     * @Route("/main", name="main")
     */
    public function showAllBooks()
    {
        return $this->render('main/_all_books.html.twig', [
            'all_books'=> $this->getAllBooks()
        ]);
    }
     /**
     * @Route("/main/{id}", name="category")
     */
    public function showBooksByCategory($id)
    {
        $books = $this->getDoctrine()
        ->getRepository(Books::class)
        ->findOneByIdJoinedToCategory($id);
        return $this->render('book/_category_books.html.twig', [
            'books' => $books,
        ]);
    }

    public function getCategories()
    {
        return  $this->getDoctrine()->getRepository(BooksCategory::class)->findAll();
    }

    public function getAllBooks()
    {
        return  $this->getDoctrine()->getRepository(Books::class)->findAll();
    }
}
