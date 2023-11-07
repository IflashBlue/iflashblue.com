<?php

namespace App\Controller\Site;

use App\Entity\Home\Home;
use App\Repository\HomeRepository;
use App\Repository\ProjectRepository;
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
    public function index(HomeRepository $homeRepository, ProjectRepository $projectRepository): Response
    {
        /** @var Home|null $home */
        $home = $homeRepository->findOneBy([]);

        return $this->render('views/home/index.html.twig', [
            'home' => $home,
            'projects' => $projectRepository->findBy(['highlight' => true], ['order' => 'ASC']),
        ]);
    }
}
