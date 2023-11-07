<?php

namespace App\Entity\Home;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\ImageInterface;
use App\Entity\ImageTrait;
use App\Entity\TranslationInterface;
use App\Entity\TranslationTrait;
use App\Repository\HomeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: HomeRepository::class)]
#[ORM\Table(name: '`home`')]
#[Gedmo\TranslationEntity(class: HomeTranslation::class)]
class Home implements TranslationInterface, EntityInterface, ImageInterface
{
    use ImageTrait;
    use TranslationTrait {
        TranslationTrait::__construct as private __translationConstruct;
    }
    use EntityTrait;

    public function __construct()
    {
        $this->__translationConstruct();
    }

    #[ORM\ManyToMany(
        targetEntity: HomeTranslation::class,
        cascade: ['persist', 'remove', 'merge'],
        fetch: 'EAGER',
        orphanRemoval: true,
        indexBy: 'locale')
    ]
    #[ORM\JoinTable(name: 'home_translations')]
    #[ORM\JoinColumn(name: 'object_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'translation_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    #[ORM\OrderBy(['locale' => 'DESC'])]
    protected Collection $translations;
}
