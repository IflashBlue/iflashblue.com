<?php

namespace App\Site\Controller;

use App\Admin\Entity\Home\Home;
use App\Admin\Repository\ArticleRepository;
use App\Admin\Repository\HomeRepository;
use App\Admin\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[
    Route(path: '/'),
    Route(path: '/{_locale}', requirements: ['_locale' => 'fr|en'])
]
class HomeController extends AbstractController
{
    #[Route(name: 'app_index', methods: ['GET'])]
    public function index(
        HomeRepository $homeRepository,
        ProjectRepository $projectRepository,
        ArticleRepository $articleRepository,
    ): Response
    {
        /** @var Home|null $home */
        $home = $homeRepository->findOneBy([]);

        return $this->render('site/views/home/index.html.twig', [
            'home' => $home,
            'projects' => $projectRepository->findBy(['highlight' => true], ['order' => 'ASC'], 5),
            'articles' => $articleRepository->findBy(['highlight' => true], ['order' => 'ASC'], 5),
        ]);
    }
}
