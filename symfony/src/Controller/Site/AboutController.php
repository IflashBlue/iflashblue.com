<?php

namespace App\Controller\Site;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale}/about', requirements: ['_locale' => 'fr|en'])]
class AboutController extends AbstractController
{
    #[Route(name: 'app_about', methods: ['GET'])]
    public function about(UserRepository $userRepository): Response
    {
        return $this->render('views/about/index.html.twig', [
            'users' => $userRepository->findBy([], ['username' => 'ASC']),
        ]);
    }
}
