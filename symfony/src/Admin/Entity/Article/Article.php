<?php

namespace App\Admin\Entity\Article;

use App\Admin\Repository\ProjectRepository;
use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\TranslationInterface;
use App\Entity\TranslationTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\Table(name: '`article`')]
#[Gedmo\TranslationEntity(class: ArticleTranslation::class)]
class Article implements TranslationInterface, EntityInterface
{
    use TranslationTrait {
        TranslationTrait::__construct as private __translationConstruct;
    }
    use EntityTrait;

    public function __construct()
    {
        $this->__translationConstruct();
        $this->images = new ArrayCollection();
    }

    #[ORM\Column(name: '`order`', type: Types::INTEGER, nullable: true)]
    private ?int $order = null;

    #[ORM\Column(name: '`highlight`', type: Types::BOOLEAN, options: ['default' => 0])]
    private bool $highlight = false;

    #[ORM\ManyToMany(
        targetEntity: ArticleTranslation::class,
        cascade: ['persist', 'remove', 'merge'],
        fetch: 'EAGER',
        orphanRemoval: true,
        indexBy: 'locale')
    ]
    #[ORM\JoinTable(name: 'projects_translations')]
    #[ORM\JoinColumn(name: 'object_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'translation_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    #[ORM\OrderBy(['locale' => 'DESC'])]
    protected Collection $translations;

    #[ORM\ManyToMany(
        targetEntity: ArticleImage::class,
        cascade: ['all'],
        fetch: 'EAGER',
        orphanRemoval: true
    )]
    #[ORM\JoinTable(name: 'projects_images')]
    #[ORM\JoinColumn(name: 'project_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'image_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    #[ORM\OrderBy(['order' => 'ASC'])]
    protected Collection $images;

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): void
    {
        $this->order = $order;
    }

    public function isHighlight(): bool
    {
        return $this->highlight;
    }

    public function setHighlight(bool $highlight): void
    {
        $this->highlight = $highlight;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function setImages(Collection $images): void
    {
        $this->images = $images;
    }
}
