<?php

namespace App\Admin\Entity\Configuration;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\TranslatableInterface;
use App\Entity\TranslatableTrait;
use App\Entity\TranslationTrait;
use App\Admin\Repository\ConfigurationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigurationRepository::class)]
#[ORM\Table(name: '`configuration`')]
class Configuration implements EntityInterface
{
    use TranslationTrait {
        TranslationTrait::__construct as private __translationConstruct;
    }
    use EntityTrait;

    public function __construct()
    {
        $this->__translationConstruct();
    }

    #[ORM\ManyToMany(
        targetEntity: ConfigurationTranslation::class,
        cascade: ['persist', 'remove', 'merge'],
        fetch: 'EAGER',
        orphanRemoval: true,
        indexBy: 'locale')
    ]
    #[ORM\JoinTable(name: 'configuration_translations')]
    #[ORM\JoinColumn(name: 'object_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'translation_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    #[ORM\OrderBy(['locale' => 'DESC'])]
    protected Collection $translations;

    #[ORM\Column(type: Types::BOOLEAN, nullable: false, options: ['default' => 0])]
    private bool $maintenance = false;

    public function isMaintenance(): bool
    {
        return $this->maintenance;
    }

    public function getMaintenance(): bool
    {
        return $this->maintenance;
    }

    public function setMaintenance(bool $maintenance): void
    {
        $this->maintenance = $maintenance;
    }
}
