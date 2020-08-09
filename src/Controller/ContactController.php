<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    public function contact(MailerInterface $mailer)
    
    
    { if(!empty($_POST)){

        $safe = array_map('trim', array_map('strip_tags', $_POST));

        $errors = [
            
                (strlen($safe['nickname']) < 2 || strlen($safe['nickname']) > 50) ? 'Votre Prénom doit comporter entre 2 et 50 caractères' : null,
                // (empty($safe['nickname'])) ? 'Votre nom doit être valide' : null,
                
                (strlen($safe['familyname']) < 2 || strlen($safe['familyname']) > 50) ? 'Votre nom doit comporter entre 2 et 50 caractères' : null,
                // (empty($safe['familyname'])) ? 'Votre nom doit être valide' : null,
               
                (strlen($safe['pseudo']) < 2 || strlen($safe['pseudo']) > 50) ? 'Votre Pseudo doit comporter entre 2 et 50 caractères' : null,
                // (empty($safe['pseudo'])) ? 'Votre nom doit être valide' : null,

                (!filter_var($safe['email'], FILTER_VALIDATE_EMAIL)) ? 'Votre mail doit être valide' : null,

                (strlen($safe['object']) < 2 || strlen($safe['object']) > 100) ? 'Votre Objet doit comporter entre 2 et 100 caractères' : null,
                // (empty($safe['object'])) ? 'Votre champ objet doit être valide' : null,

                (strlen($safe['message']) < 20 || strlen($safe['message']) > 1500) ? 'Votre message doit comporter entre 50 et 1500 caractères' : null,
                // (empty($safe['message'])) ? 'Votre message doit être valide.' : null,

        ];
        // Automatiquement supprimer les entrées vides de mon tableau
        $errors = array_filter($errors);



        if(count($errors) === 0){

            $messageHTML = '<p>Bonjour,';

            $messageHTML.= '<br>Vous avez été contacté par le formulaire de votre site.</p>';

            $messageHTML.= '<ul>';

            $messageHTML.= '<li>Nom & prénom : '.mb_strtoupper($safe['nickname']).' '.$safe['familyname'].'</li>';

            $messageHTML.= '<li>Objet : '.$safe['object'].' '.'</li>';

            $messageHTML.= '<li>Message : '.nl2br($safe['message']).' '.'</li>';

            $messageHTML.= '</ul>';

            $email = new Email();

            $email->from($safe['email']);

            // Mettre nimporte quel adresse
            $email->to('machinazic@gmail.com');

            $email->replyTo($safe['email']);



            $email->subject('Contact du site en date du '.date('d/m/Y H:i'));

            $email->html($messageHTML); 

            $email->text(strip_tags($messageHTML)); 

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('home');
            }
            else {

            dump($safe);

            $errorsMessage = implode('<br>', $errors);// implode() transforme mon tableau d'erreur en une chaine de caractères

            $this->addFlash('danger', $errorsMessage);

        }

    }
    return $this->render('contact/contact.html.twig', [
        'input_saisis' => $safe ?? [], // Me permet de reprendre mes données déjà saisies dans la vue
        ]);
    }
}


