<?php

namespace App\Controller;

use App\Entity\Studnet;
use App\Repository\UniversityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/studnet')]
class StudnetController extends AbstractController
{
    #[Route('/studnet', name: 'app_studnet')]
    public function index(): Response
    {
        return $this->render('studnet/index.html.twig', [
            'controller_name' => 'StudnetController',
        ]);
    }

    #[Route('/add', name: 'addstudent')]
    public function addstudent(ManagerRegistry $mr,UniversityRepository $repo): Response
    {
        $st = new Studnet();
        $university=$repo->find(7);
        $st->setCin(12345678);
        $st->setEmail('email');
        $st->setName('med');
        $st->setSurname('benmed');
        $st->setUniver($university);
        $em = $mr->getManager();
        $em->persist($st);
        $em->flush();
        return new Response('added');
    }
}
