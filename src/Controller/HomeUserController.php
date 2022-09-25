<?php

namespace App\Controller;

use App\Form\UsersType;
use App\Repository\UsersRepository;
use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ContainerI39uXJ9\PaginatorInterface_82dac15;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class HomeUserController extends AbstractController
{
    #[Route('/home/user', name: 'app_home_user')]
    #[IsGranted('ROLE_USER')]
    public function index(ArticlesRepository $ArticlesRepository, PaginatorInterface $paginator,
                          Request $Request): Response
    {
        $data = $ArticlesRepository->findBy(array(), array('id' => 'desc'));
        $articles = $paginator->paginate(
            $data,
            $Request->query->getInt('page',1),3
        );
        return $this->render('home_user/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articles
        ]);
    }

    #[Route('/home/profile', name: 'app_user_profile')]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher, UsersRepository $userRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_home_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home_user/profile.html.twig', [
            'article' => $user,
            'form' => $form,
        ]);
    }
    
    
}
