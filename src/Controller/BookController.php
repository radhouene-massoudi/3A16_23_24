<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\LivreType;
use App\Repository\BookRepository;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/addbook', name: 'addbook')]
    public function addbook(Request $req, ManagerRegistry $mr): Response
    {
        $book = new Book();
        $form = $this->createForm(LivreType::class, $book);
        $form->handleRequest($req);
        if ($form->isSubmitted() ) {
            $title = $book->getTitle();
            //$cat = $book->getCategory();
          
            if (str_starts_with($title, 'book_')) {
                //new \Datetime('now')
                //date_create('now')
                $age=$book->getAuthors()->getAge();
                if($age>60){
                $book->setPublicationDate(new \DateTime('now'));
                $em = $mr->getManager();
                $em->persist($book);
                $em->flush();
               return $this->redirectToRoute('fetchbook');
            } else{
                return new Response("l'age <60");
            }
            }else{
                return new Response('commence par book_');
            }
        }
      /*  return $this->render('book/newbook.html.twig', [
            "f" => $form->createView()
        ]);*/
        return $this->renderForm(
            'book/newbook.html.twig', [
                "f" => $form
            ] 
        );
    }

    #[Route('/update/{id}', name: 'update')]
    public function update(Request $req, ManagerRegistry $mr,$id,BookRepository $repo): Response
    {
        $book = $repo->find($id);
        $form = $this->createForm(LivreType::class, $book);
        $form->handleRequest($req);
        if ($form->isSubmitted() ) {
            $title = $book->getTitle();
            //$cat = $book->getCategory();
          
            if (str_starts_with($title, 'book_')) {
                //new \Datetime('now')
                //date_create('now')
                $age=$book->getAuthors()->getAge();
                if($age>60){
                $book->setPublicationDate(new \DateTime('now'));
                $em = $mr->getManager();
               // $em->persist($book);
                $em->flush();

            } else{
                return new Response("l'age <60");
            }
            }else{
                return new Response('commence par book_');
            }
        }
      /*  return $this->render('book/newbook.html.twig', [
            "f" => $form->createView()
        ]);*/
        return $this->renderForm(
            'book/newbook.html.twig', [
                "f" => $form
            ] 
        );
    }
    #[Route('/fetchbook', name: 'fetchbook')]
    public function fetchBook(BookRepository $repo){
$books=$repo->findAll();
return $this->render(
    'book/listbook.html.twig', [
        "books" => $books
    ] 
);
    }
}
