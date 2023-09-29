<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }

    #[Route('/msg', name: 'appy')]
    public function msg(): Response
    {
        return new Response('bonjour a tous ');
    }
    #[Route('/html', name: 'testttttt')]
    public function html(): Response
    {
        return new Response('<h1>bonjour a tous </h1> ');
    }

    #[Route('/json', name: 'json')]
    public function jsonk()
    {
        return new JsonResponse('bonjour a tous ');
    }

    #[Route('/twig', name: 'twig')]
    public function showTwig(): Response
    {
        return $this->render('3A16/msg.html');
    }
    #[Route('/Bonj/{name}', name: 'Bonj')]
    public function Bonj($name): Response
    {
        
        return $this->render('3A16/showmsg.html.twig',[
            'message'=>$name,
        ]);
    }
    #[Route('/list', name: 'list')]
    public function list(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 0),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
            );
        
        return $this->render('3A16/list.html.twig',[
            'a'=>$authors,
        ]);
    }
}
