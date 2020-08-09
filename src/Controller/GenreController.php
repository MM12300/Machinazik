<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Genre;

class GenreController extends AbstractController
{
    public function addGenre()
    {

        $data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/genre/listing-genres.json');

        $genres = json_decode($data, true);

        foreach($genres as $key => $value){
            //insertion des genres principaux
            $genres = new Genre();
            $genres->setGenreName($key);    
            // Insertion des données SQL
            $entityManager = $this->getDoctrine()->getManager(); // C'est un peu comme la connexion bdd
            $entityManager->persist($genres); // Execution de la requete
            $entityManager->flush(); // Déconnexion 
            
            if(is_array($value)){
            foreach($value as $subgenre){
                $genres = new Genre();
                $genres->setGenreName($key);
                $genres->setSubgenreName($subgenre);
                $entityManager = $this->getDoctrine()->getManager(); // C'est un peu comme la connexion bdd
                $entityManager->persist($genres); // Execution de la requete
                $entityManager->flush(); // Déconnexion 
            }
        }
    }

        return $this->render('genre/index.html.twig', [
            'controller_name' => 'GenreController',
        ]);
    }
}
