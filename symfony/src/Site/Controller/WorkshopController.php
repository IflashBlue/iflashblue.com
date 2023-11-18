<?php

namespace App\Site\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale}/workshops', requirements: ['_locale' => 'fr|en'])]
class WorkshopController extends AbstractController
{
    #[Route(name: 'app_workshop_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('views/workshops/index.html.twig');
    }

    #[Route(path: '/{slug}', name: 'app_workshop_show', methods: ['GET'])]
    public function show(int $slug): Response
    {
        return $this->render('views/workshops/show/index.html.twig', [
            'slug' => $slug,
        ]);
    }
}
