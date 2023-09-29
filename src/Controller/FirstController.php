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
    #[Route('/html', name: 'html')]
    public function html(): Response
    {
        return new Response('<h1>bonjour a tous </h1> ');
    }

    #[Route('/json', name: 'json')]
    public function jsonk()
    {
        return new JsonResponse('bonjour a tous ');
    }
}
