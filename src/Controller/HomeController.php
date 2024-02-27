<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]

    public function homeMessage(): Response
    {
        return new Response("Coucou");
    }

    public function afficherMessage(): Response
    {
        return new Response("hello");
    }

    #[Route('/afficher/message/bis', name: 'app_afficher_message_bis')]
    public function afficherMessageBis(): Response
    {
        return new Response("hellobis");
    }

    #[Route('/bonjour/{user}', name: "bonjour")]
    public function bonjourUtilisateur($user): Response
    {
        return new Response($user);
    }

    public function bonjourBis($user): Response
    {
        return new Response($user);
    }

    public function ajouterNombre($nbr1, $nbr2): Response
    {
        if (is_numeric($nbr1) === true && is_numeric($nbr2) === true) {
            return new Response($nbr1 + $nbr2);
        } else {
            return new Response('Veuillez entrer des nombres');
        }
    }

    public function ajouterNombreCorrection($nbr1, $nbr2 ): Response
       { try{
            $reponse = $nbr1 + $nbr2;
        }catch(\Throwable $th){
            $reponse = $th->getMessage();
        }
        
        return new Response ($reponse);
    }

    public function calculate($nbr1, $nbr2, $operateur): Response
    {
        if (is_numeric($nbr1) && is_numeric($nbr2)) {
            if ($nbr2 != 0) {
                if ($operateur === 'add') {
                    return new Response($nbr1 + $nbr2);
                } else if ($operateur === 'sub') {
                    return new Response($nbr1 - $nbr2);
                } else if ($operateur === 'multi') {
                    return new Response($nbr1 * $nbr2);
                } else if ($operateur === 'div') {
                    return new Response($nbr1 / $nbr2);
                } else {
                    return new Response('Veuillez entrer un operateur valable');
                }
            } else {
                return new Response('Division par zéro impossible');
            }
        } else {
            return new Response('Veuillez entrer 2 nombres');
        }
    }
}
