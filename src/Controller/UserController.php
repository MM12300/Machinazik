<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Users;
use App\Entity\Release;
use App\Entity\Live;

class UserController extends AbstractController
{
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * Matthieu, affiche toutes les releases crée par un utilisateur en fonction de son id
     */
    public function userSpace()
    {
        if (!$this->getUser()) {
            $this->addFlash('danger', 'Seul les utilisateurs connectés peuvent accéder à l\'espace user');
            return $this->redirectToRoute('subscription_addUser'); // redirection vers la liste des recettes
        }
        //Matthieu : On accède au manager (connexion DB)
        $entityManager = $this->getDoctrine()->getManager(); 
        //On cherche toutes les releases de cet utilisateur
        $releases = $entityManager->getRepository(Release::class)->findBy(
            [
                'user'=>$this->getUser()
            ]);

        dump($releases);

        //On cherche toutes les releases de cet utilisateur
        $lives = $entityManager->getRepository(Live::class)->findBy(
            [
                'user'=>$this->getUser()
            ]);

        dump($lives);

        return $this->render('user/userspace.html.twig', [
            'controller_name' => 'UserController',
            'releases'=> $releases,
            'lives'=> $lives,
        ]);

        
    }


    /**
     * Matthieu, affiche toutes les lives crée par un utilisateur en fonction de son id
     */
    public function userLive($user_id)
    {
        //Matthieu : On accède au manager (connexion DB)
        $entityManager = $this->getDoctrine()->getManager(); 
        $user = $entityManager->getRepository(Users::class)->find($user_id);
        //On cherche toutes les releases de cet utilisateur
        $lives = $entityManager->getRepository(Live::class)->findBy(
            [
                'user'=>$user
            ]);

        dump($lives);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'releases'=> $lives,
        ]);

        
    }
}
