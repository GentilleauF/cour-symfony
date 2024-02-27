<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NameController extends AbstractController
{
    #[Route('/name/{myName}', name: 'app_name')]
    public function index($myName): Response
    {
        return $this->render('name/index.html.twig', [
            'controller_name' => $myName,
        ]);
    }
}


