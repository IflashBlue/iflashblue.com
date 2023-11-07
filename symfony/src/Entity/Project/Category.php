<?php

namespace App\Entity\Project;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\TranslationInterface;
use App\Entity\TranslationTrait;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: '`category`')]
#[Gedmo\TranslationEntity(class: CategoryTranslation::class)]
class Category implements TranslationInterface, EntityInterface
{
    use TranslationTrait {
        TranslationTrait::__construct as private __translationConstruct;
    }
    use EntityTrait;

    public function __construct()
    {
        $this->__translationConstruct();

        $this->projects = new ArrayCollection();
    }

    #[ORM\Column(name: '`order`', type: Types::INTEGER, nullable: true)]
    private ?int $order = null;

    #[ORM\ManyToMany(
        targetEntity: CategoryTranslation::class,
        cascade: ['persist', 'remove', 'merge'],
        fetch: 'EAGER',
        orphanRemoval: true,
        indexBy: 'locale')
    ]
    #[ORM\JoinTable(name: 'category_translations')]
    #[ORM\JoinColumn(name: 'object_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'translation_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    #[ORM\OrderBy(['locale' => 'DESC'])]
    protected Collection $translations;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Project::class, cascade: ['all'], fetch: 'EAGER')]
    private Collection $projects;

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): void
    {
        $this->order = $order;
    }

    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function setProjects(Collection $projects): void
    {
        $this->projects = $projects;
    }
}
