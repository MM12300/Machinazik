<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Release;
use App\Entity\Live;

class HomeController extends AbstractController
{
    public function home()
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * matthieu : efface l'article ciblé (id_release)
     */
    public function showAll()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $all_releases = $entityManager->getRepository(Release::class)->findAll();

        $entityManager = $this->getDoctrine()->getManager();
        $all_lives = $entityManager->getRepository(Live::class)->findAll();
        return $this->render('home/actualite.html.twig', [
            'releases' => $all_releases,
            'lives' => $all_lives,
        ]);
    }
    public function listepromo()
    {
        return $this->render('home/listepromo.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    public function mentionslegales()
    {
        return $this->render('home/mentionslegales.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    public function tutoriel()
    {
        return $this->render('home/tutoriel.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}

