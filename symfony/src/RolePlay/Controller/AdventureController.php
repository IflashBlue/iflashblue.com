<?php

namespace App\RolePlay\Controller;

use App\RolePlay\Entity\Adventure;
use App\RolePlay\Entity\AdventureTranslation;
use App\RolePlay\Repository\AdventureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/role-play/adventures')]
#[Route(path: '/{_locale}/role-play/adventures', requirements: ['_locale' => 'fr|en'])]
//#[IsGranted('ROLE_ADMIN')]
class AdventureController extends AbstractRolePlayController
{
    #[Route(name: 'role_play_adventures_index', methods: ['GET'])]
    public function index(AdventureRepository $repository): Response
    {
        return $this->render('role_play/views/adventures/index.html.twig', [
            'adventures' =>  $repository->findAll(),
        ]);
    }
    #[Route(path: '/{id}',name: 'role_play_adventures_show', methods: ['GET'])]
    public function show(Adventure $adventure): Response
    {
        /** @var AdventureTranslation $translation */
        $translation = $adventure->getTranslation($this->request->getLocale());

        return $this->render('role_play/views/adventures/show.html.twig', [
            'adventure' =>  $adventure,
            'translation' =>  $translation,
        ]);
    }
}
