<?php

namespace App\Controller;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
//ENTITY
use App\Entity\Users;
//PASSWORD ENCODER



class SubscriptionController extends AbstractController
{
    public function subscription()
    {
        return $this->render('subscription/subscription.html.twig', [
            'controller_name' => 'SubscriptionController',
        ]);
    }

    public function addUser(UserPasswordEncoderInterface $passwordEncoder, MailerInterface $mailer)
    {

        $this->passwordEncoder = $passwordEncoder;

        if(!empty($_POST)){
            //Collecting data from FORM and cleaning
            $safe = array_map('trim', array_map('strip_tags', $_POST));

            
            $entityManager = $this->getDoctrine()->getManager(); 
            $existing_email = $entityManager->getRepository(Users::class)->findBy(["email"=>$safe['email']]);

            // dump($safe);

            //CAPTCHA
            // $secret = '6Ld0g6UZAAAAAP3lqfESvWZhVwhm_hgjzzdNy5qe';
            // $gRecaptchaResponse = $safe['g-recaptcha-response'];

            // $recaptcha = new \ReCaptcha\ReCaptcha($secret);
            // $resp = $recaptcha->verify($gRecaptchaResponse, $_SERVER['REMOTE_ADDR']);

            // dump($resp->isSuccess());

            $errors = [
                (strlen($safe['nickname']) < 3 || strlen($safe['nickname']) > 30) ? 'Votre prénom doit comporter entre 3 et 30 caractères' : null,
                (strlen($safe['familyname']) < 3 || strlen($safe['familyname']) > 30) ? 'Votre nom doit comporter entre 3 et 30 caractères' : null,
                (strlen($safe['pseudo']) < 5 || strlen($safe['pseudo']) > 15) ? 'Votre pseudo doit comporter entre 5 et 15 caractères' : null,
                (strlen($safe['email']) < 5 || strlen($safe['email']) > 30) ? 'Votre email doit comporter entre 5 et 30 caractères' : null,
                (strlen($safe['password']) < 5 || strlen($safe['password']) > 30) ? 'Votre mot de passe doit comporter entre 5 et 30 caractères' : null,
                (strlen($safe['passwordcheck']) < 5 || strlen($safe['passwordcheck']) > 30) ? 'Vos mot de passe doivent être identiques' : null,

            ];
            
            // Delete automatically empty entries
            $errors = array_filter($errors);

            // if (count($errors) === 0 && $resp->isSuccess()) {
            if (count($errors) === 0) {
                //if no errors we send FORM datas in DB (DB = Database)
                $now = new \DateTime('now'); //creation time = now

                //Preparing data to send from FORM to DB
                $user = new Users(); // 
                
                $user->setNickname($safe['nickname']);
                $user->setFamilyname($safe['familyname']);
                $user->setPseudo($safe['pseudo']);
                $user->setEmail($safe['email']);
                $user->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    $safe['password'] 
                ));
                $user->setDateCreated($now);
                $user->setRoles(['ROLE_USER']);
                
                // Insertion des données SQL
                $entityManager = $this->getDoctrine()->getManager(); // C'est un peu comme la connexion bdd
                $entityManager->persist($user); // Execution de la requete
                $entityManager->flush(); // Déconnexion

                $messageHTML = '<p>Bonjour,';

                $messageHTML.= '<br>Vous venez de vous inscrire sur le site Machinazic.</p>';
    
                $messageHTML.= '<ul>';
    
                $messageHTML.= '<li>Sous le nom de : '.mb_strtoupper($safe['nickname']).' '.$safe['familyname'].'</li>';
    
                $messageHTML.= '<li>Votre pseudo est : '.$safe['pseudo'].' '.'</li>';
    
                $messageHTML.= '<li>Avec l\'adresse : '.nl2br($safe['email']).' '.'</li>';

                $messageHTML.= '<li>Votre inscription a bien été pris en compte cliquez sur le lien : machinazic.fr/connexion '.'</li>';

    
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
    
                $this->addFlash('success', 'Votre Inscription a été enregistré avec succès');
                return $this->redirectToRoute('home');
                    // Redirection vers une page qui liste toutes les recettes (inexistante actuellement)
            }else {
                // Il y a des erreurs
                $errorsMessage = implode('<br>', $errors); // implode() transforme mon tableau d'erreur en une chaine de caractères
                $this->addFlash('danger', $errorsMessage);
            
            }
        }
        return $this->render('subscription/addUser.html.twig', [
        'input_saisis' => $safe ?? [], // Me permet de reprendre mes données déjà saisies dans la vue
        ]);
    }
}