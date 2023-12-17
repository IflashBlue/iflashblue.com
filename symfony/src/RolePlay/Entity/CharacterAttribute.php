<?php

namespace App\RolePlay\Entity;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\RolePlay\Enum\ClasseType;
use App\RolePlay\Enum\RaceType;
use App\RolePlay\Enum\UniverseType;
use App\RolePlay\Repository\AdventureRepository;
use App\RolePlay\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`role_play_character_attribute`')]
class CharacterAttribute implements EntityInterface
{
    use EntityTrait;

    #[ORM\Column(name: '`type`', type: Types::STRING, length: 255, nullable: false)]
    private ?string $type = null;
    #[ORM\Column(name: '`link`', type: Types::TEXT, nullable: true)]
    private ?string $link = null;
    #[ORM\Column(name: '`used`', type: Types::INTEGER, nullable: true)]
    private ?int $used = 1;
    #[ORM\Column(name: '`quantity`', type: Types::INTEGER, nullable: true)]
    private ?int $quantity = 1;
    #[ORM\Column(name: '`diceRoll`', type: Types::INTEGER, nullable: true)]
    private ?int $diceRoll = 1;

}