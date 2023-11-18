<?php

namespace App\RolePlay\Controller;

use App\RolePlay\Entity\Adventure;
use App\RolePlay\Entity\Character;
use App\RolePlay\Repository\AdventureRepository;
use App\RolePlay\Repository\CharacterRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/role-play/adventures/{id_adventure}/characters')]
#[Route(path: '/{_locale}/role-play/adventures/{id_adventure}/characters', requirements: ['_locale' => 'fr|en'])]
class CharacterController extends AbstractRolePlayController
{
    #[Route(name: 'role_play_characters_index', methods: ['GET'])]
    public function index(CharacterRepository $repository): Response
    {
        return $this->render('role_play/views/characters/index.html.twig', [
            'characters' =>  $repository->findAll(),
        ]);
    }

    #[Route(path: '/{id}',name: 'role_characters_show', methods: ['GET'])]
    public function show(Character $character, AdventureRepository $repository): Response
    {
        return $this->render('role_play/views/characters/show.html.twig', [
            'character' =>  $character,
            'adventure' =>  $repository->findOneByCharacter($character),
        ]);
    }
}
