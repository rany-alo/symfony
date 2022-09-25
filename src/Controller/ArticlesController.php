<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Comments;
use App\Form\ArticlesType;
use App\Form\CommentsType;
use App\Repository\ArticlesRepository;
use App\Repository\CommentsRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticlesController extends AbstractController
{
    #[Route('/articles/{id}', name: 'app_articles_index', methods: ['GET','POST'])]
    #[IsGranted('ROLE_USER')]
    public function show($id, ArticlesRepository $ArticlesRepository, CommentsRepository $CommentsRepository, 
    Request $request): Response
    {

            $comment = new Comments();
            $form = $this->createForm(CommentsType::class, $comment);
            $form->handleRequest($request);
            $one_article = $ArticlesRepository->findOneBy(['id' => $id]);
            $comments = $CommentsRepository->findBy(['article' => $one_article], ['id' => 'desc']);
            $user = $this->getUser();
            if ($form->isSubmitted() && $form->isValid()) {
                $comment->setUser($user);
                $comment->setArticle($one_article);
                $comment->setCreatedAt(new DateTimeImmutable());

                $CommentsRepository->add($comment, true);
    
                return $this->redirectToRoute('app_articles_index', ['id' => $id], Response::HTTP_SEE_OTHER);
            }
            return $this->render('articles/index_user.html.twig', [
                'one_article' => $one_article,
                'comments' => $comments,
                'form' => $form->createView(),
            ]);
        
    }

    #[Route('/new', name: 'app_articles_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, ArticlesRepository $articlesRepository): Response
    {
        $article = new Articles();
        $form1 = $this->createForm(ArticlesType::class, $article);
        $form1->handleRequest($request);
        $user = $this->getUser();
        if ($form1->isSubmitted() && $form1->isValid()) {
            $article->setUser($user);
            $article->setCreatedAt(new \DateTimeImmutable());
            $articlesRepository->add($article, true);

            return $this->redirectToRoute('app_home_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articles/new.html.twig', [
            'article' => $article,
            'form1' => $form1,
        ]);
    }

}
