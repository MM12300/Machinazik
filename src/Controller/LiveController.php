<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Live;
use App\Entity\Genre;
use Intervention\Image\ImageManager as image;

class LiveController extends AbstractController
{
    public function live()
    {
        return $this->render('live/live.html.twig', [
            'controller_name' => 'LiveController',
        ]);
    }



    /**
     * matthieu : Permet d'ajouter un live en base de données (par rapport à l'id d'un user donc l'user doit être connecté)
     */
    public function addLive()
    {
        //matthieu On vérifie si l'user est connecté
        if (!$this->getUser()) {
            $this->addFlash('danger', 'Seul les utilisateurs connectés peuvent créer un évenement.');
            return $this->redirectToRoute('app_login'); // redirection vers la liste des recettes
        }

        //Matthieu : LISTE DES GENRES
        $genres = $this->getDoctrine()->getRepository(Genre::class)->findAllGenre();
        $genre_list = [];
        foreach ($genres as $sub) {
            $genre_list[] = $sub->getGenreName();
        }

        //Matthieu : LISTE DES SOUS GENRES
        //// axel On aurait également pu faire un find($id_sub) lors de la soumission, on fait une comparaison via un tableau là
        $list_available_sub = [];
        $subgenres = $this->getDoctrine()->getRepository(Genre::class)->findAllSubGenre();
        foreach ($subgenres as $sub) {
            // axel : tableau contenant tous les id des subgenres (tous, sans exception)
            $list_available_sub[] = $sub->getId();
        }

        //Matthieu : LISTE LIVE_TYPE
        $live_type = ['Concert', 'Showcase', 'Festival', 'Release Party'];

        if (!empty($_POST)) {
            $safe = array_map('trim', array_map('strip_tags', $_POST));
            $now = new \DateTime('now');
            $now->format('Y-m-d');
            $postdate = new \Datetime($safe['live_date']);
            $postdate->format('Y-m-d');

            $errors = [
                //anthonyVerif artiste
                (strlen($safe['artist']) < 2 || strlen($safe['artist']) > 100) ? 'Le nom de l\'artiste doit comporter entre 2 et 100 caractères' : null,

                //matthieu Verif genre, menu select
                (!in_array(($safe['genre']), $genre_list)) ? 'Veuillez indiquer un genre comme indiqué dans la liste' : null,

                // axel: Verif subgenre, je force via un ternaire la valeur "0" puisque sur le <select> j'ai mis un disabled
                // via ce ?? 0 si subgenre n'est pas choisi, il vaudra 0 dans cette condition, 0 ne peut pas être un id en SQL
                (!in_array(($safe['subgenre'] ?? 0), $list_available_sub)) ? 'Veuillez indiquer un sous-genre comme indiqué dans la liste' : null,

                //Matthieu Verif CD CASSETTE VINYL DIGITAL
                (!in_array(($safe['live_type'] ?? 0), $live_type)) ? 'Veuillez indiquer un type de live' : null,

                //anthony Verif nom de la sortie
                (strlen($safe['live_name']) < 4 || strlen($safe['live_name']) > 50) ? 'Votre nom du live doit comporter entre 4 et 50 caractères' : null,

                //anthony Verif date (ne peut pas être plus tôt que now())
                (empty($postdate) || $now > $postdate) ? "Votre oeuvre ne peut être publiée à une date antérieure à celle d'aujourd'hui" : null,

                //luckian verif code postal
                (!is_numeric($safe['postcode']) && strlen($safe['postcode']) != 5) ? 'Le code postal doit contenir 5 chiffres' : null,

                //Matthieu verif ville
                (strlen($safe['ville']) < 2 || strlen($safe['ville']) > 100) ? 'Veuillez indiquer une ville' : null,

                //Matthieu verif adresse
                (strlen($safe['address']) < 2 || strlen($safe['address']) > 100) ? 'Veuillez indiquer une addresse' : null,

                //anthony Verif description
                (strlen($safe['description']) < 50 || strlen($safe['description']) > 1500) ? 'Votre description doit comporter entre 50 et 1500 caractères' : null,

                //LUCKIAN Verif PRICE
                (!is_numeric($safe['price']) || $safe['price'] < 0 || $safe['price'] > 200) ? 'Votre prix est invalide.' : null,

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

            $errors = array_filter($errors);

            //!!!!!!!!
            //matthieu GESTION DE l'IMAGE
            //!!!!!!!!

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


                //gestion des sous genres 
                $subgenre = $this->getDoctrine()->getRepository(Genre::class)->findOneBy(['id' => $safe['subgenre']]);

                //matthieu new Entity
                $live = new Live();
                $live->setArtist($safe['artist']);
                $live->setGenre($safe['genre']);
                $live->setSubgenre($subgenre->getSubgenreName());
                $live->setImage($image_final_name);
                $live->setLiveType($safe['live_type']);
                $live->setLiveName($safe['live_name']);
                $live->setDateLive($safe['live_date']);
                $live->setDateLive($safe['live_date']);
                $live->setSchedule($safe['schedule']);

                $live->setAddress($safe['address']);
                $live->setPostcode($safe['postcode']);
                $live->setVille($safe['ville']);
                $live->setLatitude($safe['latitude']);
                $live->setLongitude($safe['longitude']);

                $live->setDescription($safe['description']);
                $live->setDateCreated($now);


                $live->setUser($this->getUser()); //matthieu Récupère l'id de l'utilisateur


                //matthieuInput qui ne sont pas obligatoire
                if (!empty($safe['price'])) {
                    $live->setPrice($safe['price']);
                }
                if (!empty($safe['ticket'])) {
                    $live->setTicket($safe['ticket']);
                }
                //matthieu SOCIAL
                if (!empty($safe['fb'])) {
                    $live->setFacebook($safe['fb']);
                }
                if (!empty($safe['ig'])) {
                    $live->setInstagram($safe['ig']);
                }
                if (!empty($safe['twitter'])) {
                    $live->setTwitter($safe['ig']);
                }
                //matthieu MUSIC
                if (!empty($safe['yt'])) {
                    $live->setYoutube($safe['yt']);
                }

                if (!empty($safe['deezer'])) {
                    $live->setDeezer($safe['deezer']);
                }

                if (!empty($safe['soundcloud'])) {
                    $live->setSoundcloud($safe['soundcloud']);
                }

                if (!empty($safe['spotify'])) {
                    $live->setSpotify($safe['spotify']);
                }
                //matthieu Insertion des données SQL
                $entityManager = $this->getDoctrine()->getManager(); // C'est un peu comme la connexion bdd
                $entityManager->persist($live); // Execution de la requete
                $entityManager->flush(); // Déconnexion
                
                $this->addFlash('success', 'Votre article "évènement" a bien été ajouté');
                return $this->redirectToRoute('user');
                //$this->addFlash('success', 'Votre recette a bien été ajoutée');
            } else {
                //matthieu Il y a des erreurs
                $errorsMessage = implode('<br>', $errors); // implode() transforme mon tableau d'erreur en une chaine de caractères
                $this->addFlash('danger', $errorsMessage);
            }
        }


        return $this->render('live/addLive.html.twig', [
            'input_saisis' => $safe ?? [], // Me permet de reprendre mes données déjà saisies dans la vue
            'genres' => $genres,
        ]);
    }


    /**
     * matthieu : affiche un article_live (en fonction de son ID)
     */
    public function viewlive($live_id)
    {
        //matthieu On accède au manager (connexion DB)
        $entityManager = $this->getDoctrine()->getManager();
        //matthieu On passe le paramètre $live_id récupéré de l'URL pour chercher la recette donnée
        $live = $entityManager->getRepository(Live::class)->find($live_id);

        if (!$live) {
            throw $this->createNotFoundException('Cette article n\'existe pas');
        }

        return $this->render('live/live.html.twig', [
            'live' => $live
        ]);
    }

    /**
     * matthieu : efface l'article ciblé (id_live)
     */
    public function deleteLive(int $live_id)
    {

        // On accède au manager (connexion DB)
        $entityManager = $this->getDoctrine()->getManager();
        // On passe le paramètre $id_cook récupéré de l'URL pour chercher la recette donnée
        $live = $entityManager->getRepository(Live::class)->find($live_id);

        if (!$live) {
            throw $this->createNotFoundException('Cette recette n\'existe pas');
        }

        if (!empty($_POST)) {
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                // Suppression
                $entityManager->remove($live);
                $entityManager->flush();

                $this->addFlash('success', 'Votre article "évènement" a bien été supprimé');
                return $this->redirectToRoute('user'); // redirection vers la liste des recettes
            }
        }


        return $this->render('live/deleteLive.html.twig', [
            'live' => $live,
        ]);
    }

    public function updateLive(int $live_id)
    {
        //luckian VERIFIER SI UN USER EST CONNECTÉ AVANT DE POUVOIR LANCER LA PAGE
        if (!$this->getUser()) {
            return new Response('Seul les utilisateurs connectés peuvent accéder a cette page', 403);
        }

        //luckian : récup des genres
        $genres = $this->getDoctrine()
            ->getRepository(Genre::class)
            ->findAllGenre();
            foreach ($genres as $sub) {
                $genre_list[] = $sub->getGenreName();
            }

            // axel On aurait également pu faire un find($id_sub) lors de la soumission, on fait une comparaison via un tableau là
        $list_available_sub = [];
        $subgenres = $this->getDoctrine()->getRepository(Genre::class)->findAllSubGenre();
        foreach ($subgenres as $sub) {
            // axel : tableau contenant tous les id des subgenres (tous, sans exception)
            $list_available_sub[] = $sub->getId();
        }

        //LUCKIAN : LISTE LIVE_TYPE
        $live_type = ['Concert', 'Showcase', 'Festival', 'Release Party'];


        $entityManager = $this->getDoctrine()->getManager();
        $live = $entityManager->getRepository(Live::class)->find($live_id);

        if (!$live) {
            throw $this->createNotFoundException(
                'Le live identifiant : ' . $live_id . ' ne peut pas être modifié car existe pas'
            );
        }

        if (!empty($_POST)) {
            $safe = array_map('trim', array_map('strip_tags', $_POST));
            $now = new \DateTime('now');
            $postdate = $safe['live_date'];

            $errors = [
                //luckian Verif artiste
                (strlen($safe['artist']) < 2 || strlen($safe['artist']) > 100) ? 'Le nom de l\'artiste doit comporter entre 2 et 100 caractères' : null,

                //luckian Verif genre, menu select
                (!in_array(($safe['genre']), $genre_list)) ? 'Veuillez indiquer un genre comme indiqué dans la liste' : null,

                // Luckian Verif subgenre, je force via un ternaire la valeur "0" puisque sur le <select> j'ai mis un disabled
                // via ce ?? 0 si subgenre n'est pas choisi, il vaudra 0 dans cette condition, 0 ne peut pas être un id en SQL
                (!in_array(($safe['subgenre'] ?? 0), $list_available_sub)) ? 'Veuillez indiquer un sous-genre comme indiqué dans la liste' : null,

                //Luckian Verif CD CASSETTE VINYL DIGITAL
                (!in_array(($safe['live_type'] ?? 0), $live_type)) ? 'Veuillez indiquer un type de live' : null,

                //Luckian Verif nom de la sortie
                (strlen($safe['live_name']) < 4 || strlen($safe['live_name']) > 50) ? 'Votre nom de concert doit comporter entre 4 et 50 caractères' : null,

                //Luckian Verif date (ne peut pas être plus tôt que now())
                (empty($postdate) || $now < $postdate) ? "Votre oeuvre ne peut être publiée à une date antérieure à celle d'aujourd'hui" : null,


                //luckian verif code postal
                (!is_numeric($safe['postcode']) && strlen($safe['postcode']) != 5) ? 'Le code postal doit contenir 5 chiffres' : null,

                //Matthieu verif ville
                (strlen($safe['ville']) < 2 || strlen($safe['ville']) > 100) ? 'Veuillez indiquer une ville' : null,

                //Matthieu verif adresse
                (strlen($safe['address']) < 2 || strlen($safe['address']) > 100) ? 'Veuillez indiquer une addresse' : null,


                //Luckian Verif description
                (strlen($safe['description']) < 50 || strlen($safe['description']) > 1500) ? 'Votre description doit comporter entre 50 et 1500 caractères' : null,

                //LUCKIAN Verif PRICE
                (!is_numeric($safe['price']) || $safe['price'] < 1 || $safe['price'] > 1000) ? 'Votre prix est invalide.' : null,

                //Luckian Verif Facebook
                (strlen($safe['fb']) > 200) ? 'L\'URL ne doit pas comporter plus de 200 caractères' : null,

                //Luckian Verif Instagram
                (strlen($safe['ig']) > 100) ? 'L\'URL ne doit pas comporter plus de 100 caractères' : null,

                //Luckian Verif Twitter
                (strlen($safe['twitter']) > 100) ? 'L\'URL ne doit pas comporter plus de 100 caractères' : null,

                //Luckian Verif Youtube
                (strlen($safe['yt']) > 50) ? 'L\'URL ne doit pas comporter plus de 50 caractères' : null,

                //Luckian Verif Deezer
                (strlen($safe['deezer']) > 30) ? 'L\'URL ne doit pas comporter plus de 30 caractères' : null,

                //Luckian Verif Spotify
                (strlen($safe['spotify']) > 40) ? 'L\'URL ne doit pas comporter plus de 40 caractères' : null,

                //Luckian Verif Soundcloud
                (strlen($safe['soundcloud']) > 100) ? 'L\'URL ne doit pas comporter plus de 100 caractères' : null,

            ];
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
                
                //gestion des sous genres 
                $subgenre = $this->getDoctrine()->getRepository(Genre::class)->findOneBy(['id' => $safe['subgenre']]);

                //luckian new Entity
                $live->setArtist($safe['artist']);
                $live->setGenre($safe['genre']);
                $live->setSubgenre($subgenre->getSubgenreName());
                $live->setImage($image_final_name);
                $live->setLiveType($safe['live_type']);
                $live->setLiveName($safe['live_name']);
                $live->setDateLive($safe['live_date']);
                $live->setSchedule($safe['schedule']);

                $live->setAddress($safe['address']);
                $live->setPostcode($safe['postcode']);
                $live->setVille($safe['ville']);
                $live->setLatitude($safe['latitude']);
                $live->setLongitude($safe['longitude']);

                $live->setDescription($safe['description']);
                $live->setDateCreated($now);



                //luckian qui ne sont pas obligatoire
                if (!empty($safe['price'])) {
                    $live->setPrice($safe['price']);
                }
                if (!empty($safe['ticket'])) {
                    $live->setTicket($safe['ticket']);
                }
                //luckian SOCIAL
                if (!empty($safe['fb'])) {
                    $live->setFacebook($safe['fb']);
                }
                if (!empty($safe['ig'])) {
                    $live->setInstagram($safe['ig']);
                }
                if (!empty($safe['twitter'])) {
                    $live->setTwitter($safe['ig']);
                }
                //luckian MUSIC
                if (!empty($safe['yt'])) {
                    $live->setYoutube($safe['yt']);
                }

                if (!empty($safe['deezer'])) {
                    $live->setDeezer($safe['deezer']);
                }

                if (!empty($safe['soundcloud'])) {
                    $live->setSoundcloud($safe['soundcloud']);
                }

                if (!empty($safe['spotify'])) {
                    $live->setSpotify($safe['spotify']);
                }
                $entityManager->flush(); // Déconnexion
                
                $this->addFlash('success', 'Votre article "évènement" a bien été modifié');
                return $this->redirectToRoute('user');
                //Redirection vers une page qui liste toutes les recettes
            } else {
                $errormsg = implode('<br>', $errors);
                $this->addFlash('danger', $errormsg);
            }
        }

        return $this->render('live/updateLive.html.twig', [
            'input_saisis' => $safe ?? [], // Me permet de reprendre mes données déjà saisies dans la vue
            'live' => $live,
            'genres' => $genres,

        ]);
    }

    /**
     * Matthieu : fonction d'upload d'image avec image intervention
     */
    private function uploadImage(string $imgFinalName, string $outFolder, int $quality, array $extensions, int $maxSize)
    {
        $maxSize = 1024 * 1024 * $maxSize; //convert Mo to octets
        $file = $_FILES['image'];

        if ($file['error'] == UPLOAD_ERR_NO_FILE /* Ou == 4 */) {
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


    /**
     * axel : Requete Ajax qui va permettre de récupérer une liste de sous-genres
     */
    public function ajaxSubGenres()
    {
        if (!(empty($_POST))) {
            $safe = array_map('trim', array_map('strip_tags', $_POST));

            // genre => la valeur sélectionnée dans la vue addlive.html.twig
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
}
