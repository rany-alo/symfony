<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CommentsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: 'app_article', methods: ['GET', 'POST'])]
    public function oneArticle($id, ArticlesRepository $ArticlesRepository, CommentsRepository $CommentsRepository): Response
    {        
        $one_article = $ArticlesRepository->findBy(array('id' => $id));
        $comments = $CommentsRepository->findBy(array('article' => $one_article));
        return $this->renderForm('articles/index.html.twig', [
            'controller_name' => 'OneArticleController',
            'one_article' => $one_article,
            'comments' => $comments,
        ]);

    }
    
   
}
