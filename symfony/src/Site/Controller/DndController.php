<?php

namespace App\Site\Controller;

use App\Admin\Entity\Dnd\DndCharacter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[
    Route(path: '/dnd'),
    Route(path: '/{_locale}/dnd', requirements: ['_locale' => 'fr|en'])
]
class DndController extends AbstractController
{

    public function __construct()
    {
       $this->characters = [
           new DndCharacter(
               1,
            'Eärendil Siderion',
            'Magician',
            1,
            'Sage (astronome)',
            'Nathanaël',
            'Elfe',
            'chaotique bon',
            0
        )
           ];
    }
    /* TODO load data from repository*/
    /**
     * @var DndCharacter[]
     */
    private readonly array $characters;


    #[Route(name: 'dnd_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('views/dnd/index.html.twig', [
            'characters' => $this->characters,
        ]);
    }
    #[Route(path:'/{id}', name: 'dnd_show', methods: ['GET'])]
    public function show(int $id): Response // TODO uuid
    {
        /* TODO load data from repository*/
        /** @var DndCharacter|null $character */
        $character = current(array_filter( $this->characters, fn(DndCharacter $character) => $character->id == $id));

        if (!$character) {
            throw new NotFoundHttpException(); // TODO should be manage by param converter
        }

        return $this->render('views/dnd/edit.html.twig', [
            'character' => $character,
        ]);
    }
}
