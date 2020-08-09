<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
//ATTENTION ROUTE EFFACÉE
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        if ($this->getUser()) {
            $this->addFlash('success', 'Bonjour '.$this->getUser()->getUsername().', bienvenue sur Machinazic');
            return $this->redirectToRoute('user');
        }

        if (!$this->getUser()) {
        //     $this->addFlash('danger', 'Veuillez indiquer un identifiant valide ou créer un compte');
        //     return $this->redirectToRoute('app_login');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        if(!empty($error)){
            $this->addFlash('danger', 'Veuillez indiquer un identifiant valide ou créer un compte');
        }
        
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        }
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        if ($this->getUser()) {
            $this->addFlash('success', 'Merci de votre visite '.$this->getUser()->getUsername().', en espérant vous revoir bientot !');
            return $this->redirectToRoute('user');
        }
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');

    }
}
