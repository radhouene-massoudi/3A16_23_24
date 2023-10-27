<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/au/{k}', name: 'app_author')]
    public function showAuthor($k): Response
    {
        return $this->render('author/msg.html.twig', [
            'name' => $k,
        ]);
    }
    #[Route('/authors', name: 'authors')]
    public function listAuthor(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
            );
        return $this->render('author/list.html.twig', [
            'tab' => $authors,
        ]);
    }
    #[Route('/detail/{id}', name: 'detail')]
    public function auhtorDetails($id){

        return $this->render('author/detail.html.twig', [  
        ]);

    }
    #[Route('/fetch', name: 'fetch')]
    public function fetchAuthors(ManagerRegistry $mr){
$repo=$mr->getRepository(Author::class);
$result=$repo->findAll();
dd($result);
    }

    #[Route('/fetchtwo', name: 'fetchtwo')]
    public function fetchtwoAuthors(AuthorRepository $repo,Request $req,EntityManagerInterface $em){
$request=$em->createQuery("select a from App\Entity\Author a");
$result=$request->getResult();
        //$result=$repo->findAll();
if($req->isMethod('post')){
    $username=$req->get('test');
    //dd($username);
    $result=$repo->findByUsername($username);
    return $this->render('author/authors.html.twig',[
        'auth'=>$result
    ]);
}
return $this->render('author/authors.html.twig',[
    'auth'=>$result
]);
    }
    #[Route('/add', name: 'add')]
    public function addAuthor(ManagerRegistry $mr){
$autho=new Author();
$autho->setUsername('med');
$autho->setEmail('test@gmail.com');
$autho->setAge(34);
$em=$mr->getManager();
$em->persist($autho);
$em->flush();
return $this->redirectToRoute('fetchtwo');
    }

    #[Route('/delete/{id}', name: 'add')]
    public function removeAuthor(ManagerRegistry $mr,$id,AuthorRepository $repo){
        $author=$repo->find($id);
        $em=$mr->getManager();
        if($author!=null){
        $em->remove($author);
        $em->flush();
    }else{
        return new Response('id nexsite pas');
    }
        return $this->redirectToRoute('fetchtwo'); 
    }

    #[Route('/dql', name: 'dql')]
    public function dql(AuthorRepository $repo,EntityManagerInterface $em){
      //  $request=$em->createQuery("select a.username, b.title nom_book from App\Entity\Author a join a.books b");
       // $result=$request->getResult();
       // $result=$request->getSingleScalarResult();
       // dd($result[0][1]);
       $result=$repo->fetchAuthorByUserName('ali');
       dd($result);
    }
    #[Route('/qb', name: 'QB')]
    public function QB(AuthorRepository $repo,EntityManagerInterface $em){
      
       $result=$repo->fetchAuthors();
       dd($result);
    }

}
