<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $repository): Response
    {
        $articles = $repository->findAll();
        
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/articleDetail/{id}', name: 'app_articleDetail')]
    public function articleById($id, ArticleRepository $repository): Response {
        $articleById = $repository->findOneBy(['id' => $id]);
        return $this->render('article/articleDetail.html.twig', [
            'article' => $articleById
        ]);
    }


}
