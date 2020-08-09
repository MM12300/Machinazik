<?php

namespace App\Controller;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Release;
use App\Entity\Genre;
use Symfony\Component\HttpFoundation\Request;
use Intervention\Image\ImageManager as image;


class ReleaseController extends AbstractController
{
    public function release()
    {
        return $this->render('release/release.html.twig', [
            'controller_name' => 'ReleaseController',
        ]);
    }

    /**
     * Permet d'ajouter une release en base de données (par rapport à l'id d'un user donc l'user doit être connecté)
     */
    public function addRelease(MailerInterface $mailer)
    {
        //matthieu VERIFIER SI UN USER EST CONNECTÉ AVANT DE POUVOIR LANCER LA PAGE
        if (!$this->getUser()) {
            $this->addFlash('danger', 'Seul les utilisateurs connectés peuvent créer une sortie.');
            return $this->redirectToRoute('app_login'); // redirection vers la liste des recettes
        }

        //Matthieu : LISTE DES GENRES
        $genres = $this->getDoctrine()->getRepository(Genre::class)->findAllGenre();
        $genre_list = [];
        foreach ($genres as $sub) {
            $genre_list[] = $sub->getGenreName();
        }

        // LISTE DES SOUS GENRES axel On aurait également pu faire un find($id_sub) lors de la soumission, on fait une comparaison via un tableau là
        $subgenres = $this->getDoctrine()->getRepository(Genre::class)->findAllSubGenre();
        $list_available_sub = [];
        foreach ($subgenres as $sub) {
            // axel : tableau contenant tous les id des subgenres (tous, sans exception)
            $list_available_sub[] = $sub->getId();
        }

        //Matthieu : LISTE RELEASE_TYPE
        $release_type = ['CD', 'Digital', 'Vinyl', 'Cassette'];

        if (!empty($_POST)) {
            $safe = array_map('trim', array_map('strip_tags', $_POST));
            $now = new \DateTime('now');
            $now->format('Y-m-d');
            $postdate = new \Datetime($safe['release_date']);
            $postdate->format('Y-m-d');

            $errors = [
                //anthony Verif Artiste
                (strlen($safe['artist']) < 2 || strlen($safe['artist']) > 100) ? 'Le nom de l\'artiste doit comporter entre 2 et 100 caractères' : null,

                //matthieu Verif genre, menu select
                (!in_array(($safe['genre']), $genre_list)) ? 'Veuillez indiquer un genre comme indiqué dans la liste' : null,

                // axel: Verif subgenre, je force via un ternaire la valeur "0" puisque sur le <select> j'ai mis un disabled
                // via ce ?? 0 si subgenre n'est pas choisi, il vaudra 0 dans cette condition, 0 ne peut pas être un id en SQL
                (!in_array(($safe['subgenre'] ?? 0), $list_available_sub)) ? 'Veuillez indiquer un sous-genre comme indiqué dans la liste' : null,

                //anthony Verif Nom De La Sortie
                (strlen($safe['release_name']) < 1 || strlen($safe['release_name']) > 100) ? 'Le nom de la sortie doit comporter entre 1 et 100 caractères' : null,

                //matthieu Verif date (ne peut pas être plus tôt que now())
                (empty($postdate) || $now > $postdate) ? "Votre release ne peut être publiée à une date antérieure à celle d'aujourd'hui" : null,

                //Matthieu Verif CD CASSETTE VINYL DIGITAL
                (!in_array(($safe['release_type']), $release_type)) ? 'Veuillez indiquer un type de sortie' : null,

                //anthony Verif Description
                (strlen($safe['description']) < 50 || strlen($safe['description']) > 1500) ? 'La description doit comporter entre 50 et 1500 caractères' : null,

                //anthony Verif Facebook
                (strlen($safe['fb']) > 200) ? 'L\'URL ne doit pas comporter plus de 200 caractères' : null,

                //anthony Verif Instagram
                (strlen($safe['ig']) > 100) ? 'L\'URL ne doit pas comporter plus de 100 caractères' : null,

                //anthony Verif Twitter
                (strlen($safe['twitter']) > 100) ? 'L\'URL ne doit pas comporter plus de 100 caractères' : null,

                //anthony Verif Youtube
                (strlen($safe['yt']) > 50) ? 'L\'URL ne doit pas comporter plus de 50 caractères' : null,

                //anthony Verif Deezer
                (strlen($safe['deezer']) > 30) ? 'L\'URL ne doit pas comporter plus de 30 caractères' : null,

                //anthony Verif Spotify
                (strlen($safe['spotify']) > 40) ? 'L\'URL ne doit pas comporter plus de 40 caractères' : null,

                //anthony Verif Soundcloud
                (strlen($safe['soundcloud']) > 100) ? 'L\'URL ne doit pas comporter plus de 100 caractères' : null
            ];

            //axel Automatiquement supprimer les entrées vides de mon tableau
            $errors = array_filter($errors);

            //gestion des images         
            $image_name = null;
            if (isset($_FILES) && !empty($_FILES)) {
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $image_name = $safe['artist'];
                $image_final_name = $image_name . '.' . $extension;
            dump($image_final_name);
                //$image_bdd_name = ;
                $this->uploadImage($image_name, 'uploads', 80, ['image/jpeg', 'image/jpg', 'image/pjpeg', 'image/png'], 1);                           
            }


            if (count($errors) === 0) {    
                

                //Gestion du subgenre
                $subgenre = $this->getDoctrine()->getRepository(Genre::class)->findOneBy(['id' => $safe['subgenre']]);

                //matthieu new Entity
                $release = new Release();
                $release->setArtist($safe['artist']);
                $release->setDateCreated($now);
                $release->setImage($image_final_name);
                $release->setReleaseName($safe['release_name']);
                $release->setGenre($safe['genre']);
                $release->setSubgenre($subgenre->getSubgenreName());
                $release->setReleaseType($safe['release_type']);
                $release->setDateRelease($safe['release_date']);
                $release->setDescription($safe['description']);
                $release->setUser($this->getUser());



                //matthieu Input qui ne sont pas obligatoire
                //matthieu SOCIAL
                if (!empty($safe['fb'])) {
                    $release->setFacebook($safe['fb']);
                }
                if (!empty($safe['ig'])) {
                    $release->setInstagram($safe['ig']);
                }
                if (!empty($safe['twitter'])) {
                    $release->setTwitter($safe['ig']);
                }
                //matthieu MUSIC
                if (!empty($safe['yt'])) {
                    $release->setYoutube($safe['yt']);
                }

                if (!empty($safe['deezer'])) {
                    $release->setDeezer($safe['deezer']);
                }

                if (!empty($safe['soundcloud'])) {
                    $release->setSoundcloud($safe['soundcloud']);
                }

                if (!empty($safe['spotify'])) {
                    $release->setSpotify($safe['spotify']);
                }

                //matthieuEnregistrement des données si les données sont SET
                //matthieu$release->setImage($safe['image'])

                // Insertion des données SQL
                $entityManager = $this->getDoctrine()->getManager(); // C'est un peu comme la connexion bdd
                $entityManager->persist($release); // Execution de la requete
                $entityManager->flush(); // Déconnexion

                $this->addFlash('success', 'Votre article "sortie" a bien été ajouté');
                return $this->redirectToRoute('user');

            } else {
                //matthieu Il y a des erreurs
                $errorsMessage = implode('<br>', $errors); // implode() transforme mon tableau d'erreur en une chaine de caractères
                $this->addFlash('danger', $errorsMessage);
            }
        }

        return $this->render('release/addRelease.html.twig', [
            'input_saisis' => $safe ?? [], // Me permet de reprendre mes données déjà saisies dans la vue
            'genres' => $genres,
        ]);
    }


    /**
     * matthieu : affiche un article_release (en fonction de son ID)
     */
    public function viewRelease($release_id)
    {
        //matthieu On accède au manager (connexion DB)
        $entityManager = $this->getDoctrine()->getManager();
        //matthieu On passe le paramètre $release_id récupéré de l'URL pour chercher la recette donnée
        $release = $entityManager->getRepository(Release::class)->find($release_id);

        if (!$release) {
            throw $this->createNotFoundException('Cette article n\'existe pas');
        }

        return $this->render('release/release.html.twig', [
            'release' => $release
        ]);
    }

    /**
     * matthieu : efface l'article ciblé (id_release)
     */
    public function deleteRelease(int $release_id)
    {

        // On accède au manager (connexion DB)
        $entityManager = $this->getDoctrine()->getManager();
        // On passe le paramètre $id_cook récupéré de l'URL pour chercher la recette donnée
        $release = $entityManager->getRepository(Release::class)->find($release_id);

        if (!$release) {
            throw $this->createNotFoundException('Cette recette n\'existe pas');
        }

        if (!empty($_POST)) {
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                // Suppression
                $entityManager->remove($release);
                $entityManager->flush();

                $this->addFlash('success', 'Votre article "sortie" a bien été supprimé');
                return $this->redirectToRoute('home'); // redirection vers la liste des recettes
            }
        }

        return $this->render('release/deleteRelease.html.twig', [
            'release' => $release,
        ]);
    }

    public function updateRelease(int $release_id)
    {
        //luckian VERIFIER SI UN USER EST CONNECTÉ AVANT DE POUVOIR LANCER LA PAGE
        if (!$this->getUser()) {
            return new Response('Seul les utilisateurs connectés peuvent accéder a cette page', 403);
            
        }

        //luckian : récup des genres
        $genres = $this->getDoctrine()
            ->getRepository(Genre::class)
            ->findAllGenre();

        // axel On aurait également pu faire un find($id_sub) lors de la soumission, on fait une comparaison via un tableau là
        $list_available_sub = [];
        $subgenres = $this->getDoctrine()->getRepository(Genre::class)->findAllSubGenre();
        $genre_list = [];
        // Luckian Ajout de genre_list pour la vérif du genre envoyé
        foreach ($genres as $sub) {
            $genre_list[] = $sub->getGenreName();
        }
        foreach ($subgenres as $sub) {
            // axel : tableau contenant tous les id des subgenres (tous, sans exception)
            $list_available_sub[] = $sub->getId();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $release = $entityManager->getRepository(Release::class)->find($release_id);

            //luckian : LISTE RELEASE_TYPE
            $release_type = ['CD', 'Digital', 'Vinyl', 'Cassette'];

        if (!$release) {
            throw $this->createNotFoundException(
                'La recette identifiant : ' . $release_id . ' ne peut pas être modifié car existe pas'
            );
        }

        if (!empty($_POST)) {
            $safe = array_map('trim', array_map('strip_tags', $_POST));
            $now = new \DateTime('now');
            $now->format('Y-m-d');
            $postdate = new \Datetime($safe['release_date']);
            $postdate->format('Y-m-d');


            $errors = [
                //luckian Verif Artiste
                (strlen($safe['artist']) < 2 || strlen($safe['artist']) > 100) ? 'Le nom de l\'artiste doit comporter entre 2 et 100 caractères' : null,

                //luckian Verif genre, menu select
                (!in_array(($safe['genre']), $genre_list)) ? 'Veuillez indiquer un genre comme indiqué dans la liste' : null,

                // luckian: Verif subgenre, je force via un ternaire la valeur "0" puisque sur le <select> j'ai mis un disabled
                // via ce ?? 0 si subgenre n'est pas choisi, il vaudra 0 dans cette condition, 0 ne peut pas être un id en SQL
                (!in_array(($safe['subgenre'] ?? 0), $list_available_sub)) ? 'Veuillez indiquer un sous-genre comme indiqué dans la liste' : null,

                //luckian Verif Nom De La Sortie
                (strlen($safe['release_name']) < 1 || strlen($safe['release_name']) > 100) ? 'Le nom de l\'oeuvre doit comporter entre 1 et 100 caractères' : null,

                //luckian Verif date (ne peut pas être plus tôt que now())
                (empty($postdate) || $now > $postdate) ? "Votre release ne peut être publiée à une date antérieure à celle d'aujourd'hui" : null,

                //luckian Verif CD CASSETTE VINYL DIGITAL
                (!in_array(($safe['release_type']), $release_type)) ? 'Veuillez indiquer un type de sortie' : null,

                //luckian Verif Description
                (strlen($safe['description']) < 50 || strlen($safe['description']) > 1500) ? 'La description doit comporter entre 50 et 1500 caractères' : null,

                //luckian Verif type de sortie, menu select

                //luckian Verif Facebook
                (strlen($safe['fb']) > 200) ? 'L\'URL ne doit pas comporter plus de 200 caractères' : null,

                //luckian Verif Instagram
                (strlen($safe['ig']) > 100) ? 'L\'URL ne doit pas comporter plus de 100 caractères' : null,

                //luckian Verif Twitter
                (strlen($safe['twitter']) > 100) ? 'L\'URL ne doit pas comporter plus de 100 caractères' : null,

                //luckian Verif Youtube
                (strlen($safe['yt']) > 50) ? 'L\'URL ne doit pas comporter plus de 50 caractères' : null,

                //luckian Verif Deezer
                (strlen($safe['deezer']) > 30) ? 'L\'URL ne doit pas comporter plus de 30 caractères' : null,

                //luckian Verif Spotify
                (strlen($safe['spotify']) > 40) ? 'L\'URL ne doit pas comporter plus de 40 caractères' : null,

                //luckian Verif Soundcloud
                (strlen($safe['soundcloud']) > 100) ? 'L\'URL ne doit pas comporter plus de 100 caractères' : null,
            ];

            //luckian Automatiquement supprimer les entrées vides de mon tableau
            $errors = array_filter($errors);


            if (count($errors) === 0) {    
                //gestion des images         
                $image_name = null;
                if (isset($_FILES) && !empty($_FILES)) {
                    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $image_name = $safe['artist'];
                    $image_final_name = $image_name . '.' . $extension;

                    //$image_bdd_name = ;
                    $this->uploadImage($image_name, 'uploads', 80, ['image/jpeg', 'image/jpg', 'image/pjpeg', 'image/png'], 1);

                    // $extension = pathinfo($file['name'], PATHINFO_EXTENSION); // .jpg, ou .png ou .gif 
                    // $image_name = $imgFinalName . '.' . $extension; 
                    
                  
                }

                //Gestion du subgenre
                $subgenre = $this->getDoctrine()->getRepository(Genre::class)->findOneBy(['id' => $safe['subgenre']]);

                $release->setArtist($safe['artist']);
                $release->setDateCreated($now);
                $release->setImage($image_final_name);
                $release->setReleaseName($safe['release_name']);
                $release->setGenre($safe['genre']);
                $release->setSubgenre($subgenre->getSubgenreName());
                $release->setReleaseType($safe['release_type']);
                $release->setDateRelease($safe['release_date']);
                $release->setDescription($safe['description']);


                //luckian Input qui ne sont pas obligatoire
                //luckian SOCIAL
                if (!empty($safe['fb'])) {
                    $release->setFacebook($safe['fb']);
                }
                if (!empty($safe['ig'])) {
                    $release->setInstagram($safe['ig']);
                }
                if (!empty($safe['twitter'])) {
                    $release->setTwitter($safe['ig']);
                }
                //luckian MUSIC
                if (!empty($safe['yt'])) {
                    $release->setYoutube($safe['yt']);
                }

                if (!empty($safe['deezer'])) {
                    $release->setDeezer($safe['deezer']);
                }

                if (!empty($safe['soundcloud'])) {
                    $release->setSoundcloud($safe['soundcloud']);
                }

                if (!empty($safe['spotify'])) {
                    $release->setSpotify($safe['spotify']);
                }

                $entityManager->flush();

                $this->addFlash('success', 'Votre article "sortie" a bien été modifié');
                return $this->redirectToRoute('user');
                //Redirection vers une page qui liste toutes les realises
            } else {
                $errormsg = implode('<br>', $errors);
                $this->addFlash('danger', $errormsg);
            }
        }

        return $this->render('release/updateRelease.html.twig', [
            'input_saisis' => $safe ?? [], // Me permet de reprendre mes données déjà saisies dans la vue
            'release' => $release,
            'genres' => $genres,

        ]);
    }


    /**
     * Requete Ajax qui va permettre de récupérer une liste de sous-genres
     */
    public function ajaxSubGenres()
    {
        if (!(empty($_POST))) {
            $safe = array_map('trim', array_map('strip_tags', $_POST));

            // genre => la valeur sélectionnée dans la vue addRelease.html.twig
            if (isset($safe['genre']) && !empty($safe['genre'])) {

                $subgenres = $this->getDoctrine()->getRepository(Genre::class)->findBy(['genre_name' => $safe['genre']]);

                $subgenres_for_json = [];
                foreach ($subgenres as $sub_genre) {

                    if (!is_null($sub_genre->getSubgenreName())) {

                        // axel : je refais le tableau qui sera renvoyé en JSON
                        // L'id devient la valeur du tableau et sa valeur le nom du sous genre.
                        // C'est plus simple pour le traiter
                        $subgenres_for_json[$sub_genre->getId()] = $sub_genre->getSubgenreName();
                    }
                }
            }
        }

        // axel : Le 200 ne sert à rien, c'est déjà la valeur par défaut
        //return $this->json($subgenres_for_json, 200);
        return $this->json($subgenres_for_json);
    }


    /**
     * Matthieu : fonction d'upload d'image avec image intervention
     */
    private function uploadImage(string $imgFinalName, string $outFolder, int $quality, array $extensions, int $maxSize)
    {
        $maxSize = 1024 * 1024 * $maxSize; //convert Mo to octets
        $file = $_FILES['image'];

        if ($file['error'] == UPLOAD_ERR_NO_FILE /* Ou == 4 */) {
            $this->addFlash('errors', 'Fichier corrompu, merci de choisir une autre image');
        } elseif ($file['error'] != UPLOAD_ERR_NO_FILE) { // Si erreur différente de 4

            if (!in_array($file['type'], $extensions)) {
                $this->addFlash('errors', 'Le type de fichier n\'est pas pris en charge');
            }

            if ($file['size'] > $maxSize) {
                $this->addFlash('errors', 'La taille maxi acceptée est de 3 Mo');
            }
        }

        if (!$this->container->get('session')->getFlashBag()->has('errors')) {
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION); // .jpg, ou .png ou .gif 
            $image_name = $imgFinalName . '.' . $extension;

            dump($extension);

            $img = new image;
            $imgReal = $img->make($file['tmp_name']);
            $imgReal->save($_SERVER['DOCUMENT_ROOT'] . 'assets/img/' . $outFolder . '/' . $image_name);
        }
    }
}
