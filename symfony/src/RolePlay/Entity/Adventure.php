<?php

namespace App\RolePlay\Entity;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\TranslationInterface;
use App\Entity\TranslationTrait;
use App\RolePlay\Enum\RaceType;
use App\RolePlay\Enum\UniverseType;
use App\RolePlay\Repository\AdventureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: AdventureRepository::class)]
#[ORM\Table(name: '`role_play_adventure`')]
#[Gedmo\TranslationEntity(class: AdventureTranslation::class)]
class Adventure implements TranslationInterface, EntityInterface
{
    use TranslationTrait {
        TranslationTrait::__construct as private __translationConstruct;
    }
    public function __construct()
    {
        $this->__translationConstruct();
        $this->characters = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->universeType = UniverseType::ROLE_PLAY;
    }

    use EntityTrait;

    #[ORM\Column(name: '`start_at`', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $startAt = null;

    #[ORM\Column(name: '`end_at`', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $endAt = null;

    #[ORM\Column(name: '`race`', nullable: false, enumType: UniverseType::class)]
    private UniverseType $universeType;

    #[ORM\ManyToMany(
        targetEntity: Character::class,
        cascade: ['persist', 'remove', 'merge'],
        fetch: 'EAGER',
        orphanRemoval: true
    )]
    #[ORM\JoinTable(name: 'role_play_adventures_characters')]
    #[ORM\JoinColumn(name: 'adventure_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'character_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    protected Collection $characters;

    #[ORM\ManyToMany(
        targetEntity: AdventureImage::class,
        cascade: ['all'],
        fetch: 'EAGER',
        orphanRemoval: true
    )]
    #[ORM\JoinTable(name: 'role_play_adventure_images')]
    #[ORM\JoinColumn(name: 'adventure_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'image_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    #[ORM\OrderBy(['order' => 'ASC'])]
    protected Collection $images;

    #[ORM\ManyToMany(
        targetEntity: AdventureTranslation::class,
        cascade: ['persist', 'remove', 'merge'],
        fetch: 'EAGER',
        orphanRemoval: true,
        indexBy: 'locale')
    ]
    #[ORM\JoinTable(name: 'role_play_adventure_translations')]
    #[ORM\JoinColumn(name: 'object_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'translation_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    #[ORM\OrderBy(['locale' => 'DESC'])]
    protected Collection $translations;



    public function getStartAt(): ?\DateTime
    {
        return $this->startAt;
    }

    public function setStartAt(?\DateTime $startAt): void
    {
        $this->startAt = $startAt;
    }

    public function getEndAt(): ?\DateTime
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTime $endAt): void
    {
        $this->endAt = $endAt;
    }

    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function setCharacters(Collection $characters): void
    {
        $this->characters = $characters;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function setImages(Collection $images): void
    {
        $this->images = $images;
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function setTranslations(Collection $translations): void
    {
        $this->translations = $translations;
    }

    public function getUniverseType(): UniverseType
    {
        return $this->universeType;
    }

    public function setUniverseType(UniverseType $universeType): void
    {
        $this->universeType = $universeType;
    }

}