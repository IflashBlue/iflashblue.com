<?php

namespace App\Site\Controller;

use App\Admin\Repository\CategoryRepository;
use App\Admin\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale}/projects', requirements: ['_locale' => 'fr|en'])]
class ProjectController extends AbstractSiteController
{
    #[Route(name: 'app_project_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('views/projects/index.html.twig',
            [
                'categories' => $categoryRepository->findBy([], ['order' => 'ASC']),
            ]
        );
    }

    #[Route(path: '/{slug}', name: 'app_project_show', requirements: ['slug' => '^[a-z0-9]+(?:-[a-z0-9]+)*$'], methods: ['GET'])]
    public function show(string $slug, ProjectRepository $projectRepository): Response
    {
        $project = $projectRepository->findOneBySlugAndLocale($slug, $this->request->getLocale());

        if (null === $project) {
            return $this->redirectToRoute('app_project_index');
        }

        return $this->render('views/projects/show/index.html.twig', [
            'project' => $project,
        ]);
    }
}
