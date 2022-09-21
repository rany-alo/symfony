<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CommentsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\request;

class OneArticleController extends AbstractController
{
    #[Route('/onearticle/{id}', name: 'app_one_article')]
    public function index($id, ArticlesRepository $ArticlesRepository, CommentsRepository $CommentsRepository): Response
    {
        $one_article = $ArticlesRepository->findBy(array('id' => $id));
        $comments = $CommentsRepository->findBy(array('article' => $one_article));
        return $this->render('one_article/index.html.twig', [
            'controller_name' => 'OneArticleController',
            'one_article' => $one_article,
            'comments' => $comments,
        ]);
    }
}
