<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class Exo6Controller extends AbstractController
{
    #[Route('/exo6/{nbr1}/{nbr2}/{operateur}', name: 'app_exo6')]
    public function index($nbr1, $nbr2, $operateur): Response
    {
        return $this->render('exo6/index.html.twig',[
            'nbr1' => $nbr1,
            'nbr2' => $nbr2,
            'operateur' => $operateur
        ]);
    }
}
