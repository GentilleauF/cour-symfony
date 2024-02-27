<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalculateController extends AbstractController
{
    #[Route('/calcul/{nbr1}/{nbr2}/{operateur}', name: 'app_calcul')]
    public function index($nbr1, $nbr2, $operateur): Response
    {

        try {
            //opérateur ternaire (si nbr1 ou nbr2) n'est pas un nombre on crée une nouvelle exception
            !is_numeric($nbr1) || !is_numeric($nbr2)?throw new \Exception("nbr1 ou nbr2 ne sont pas des nombres"):null;
            //switch case de l'opérateur
            switch ($operateur) {
                case "add":
                    $message = `Le résultat de l'addition  est égal à :` . ($nbr1 + $nbr2);
                    break;
                case "sub":
                    $message = "Le résultat de la soustraction {$nbr1} - {$nbr2} est égal à : " . ($nbr1 - $nbr2);
                    break;
                case "multi":
                    $message = "Le résultat de la multiplication {$nbr1} x {$nbr2} est égal à : " . ($nbr1 * $nbr2);
                    break;
                case "div":
                    //opérateur ternaire si nbr2 == 0 on crée une nouvelle exception
                    $nbr2 == 0?throw new \Exception("la division par zéro est impossible"):null;
                    $message = "Le résultat de la division est égal à : " . ($nbr1 / $nbr2);
                    break;
                //si l'opérateur n'est pas (add ou sub ou multi ou div)
                default:
                    $message = "L'opérateur n'est pas valide";
                    break;
            }
            
        }       catch (\Throwable $th) {
            $message = "Erreur : " . $th->getMessage();
        }
        return $this->render('calculate/index.html.twig', [
            'controller_name' => $message,
        ]);
    }
}