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
#[ORM\Table(name: '`role_play_character`')]
class Character implements EntityInterface
{
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->attributes = new ArrayCollection();
    }

    use EntityTrait;

    #[ORM\Column(name: '`name`', type: Types::STRING, length: 255, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(name: '`level`', type: Types::INTEGER, nullable: true)]
    private ?int $level = 1;

    #[ORM\Column(name: '`age`', type: Types::INTEGER, nullable: true)]
    private ?int $age = null;

    #[ORM\Column(name: '`race`', nullable: true, enumType: RaceType::class)]
    private ?RaceType $raceType = null;

    #[ORM\Column(name: '`class_type`', nullable: true, enumType: ClasseType::class)]
    private ?ClasseType $classType = null;

    #[ORM\ManyToMany(
        targetEntity: CharacterImage::class,
        cascade: ['all'],
        fetch: 'EAGER',
        orphanRemoval: true
    )]
    #[ORM\JoinTable(name: 'role_play_characters_images')]
    #[ORM\JoinColumn(name: 'character_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'image_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    #[ORM\OrderBy(['order' => 'ASC'])]
    protected Collection $images;

    #[ORM\ManyToMany(
        targetEntity: CharacterAttribute::class,
        cascade: ['all'],
        fetch: 'EAGER',
        orphanRemoval: true
    )]
    #[ORM\JoinTable(name: 'role_play_characters_atttributes')]
    #[ORM\JoinColumn(name: 'character_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'attribute_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    #[ORM\OrderBy(['type' => 'ASC'])]
    protected Collection $attributes;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): void
    {
        $this->age = $age;
    }

    public function getRaceType(): ?RaceType
    {
        return $this->raceType;
    }

    public function setRaceType(?RaceType $raceType): void
    {
        $this->raceType = $raceType;
    }

    public function getClassType(): ?ClasseType
    {
        return $this->classType;
    }

    public function setClassType(?ClasseType $classType): void
    {
        $this->classType = $classType;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function setImages(Collection $images): void
    {
        $this->images = $images;
    }

    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function setAttributes(Collection $attributes): void
    {
        $this->attributes = $attributes;
    }
}