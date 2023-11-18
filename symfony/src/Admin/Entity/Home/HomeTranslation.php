<?php

namespace App\Admin\Entity\Home;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\ImageInterface;
use App\Entity\ImageTrait;
use App\Entity\TranslatableInterface;
use App\Entity\TranslatableTrait;
use App\Entity\TranslationInterface;
use App\Entity\TranslationTrait;
use App\Admin\Enum\LocaleEnum;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: '`home_translation`')]
#[ORM\UniqueConstraint(columns: ['locale', 'id'])]
class HomeTranslation implements TranslatableInterface, EntityInterface
{
    use EntityTrait;
    use TranslatableTrait;

    public function __construct(?LocaleEnum $locale = null)
    {
        if ($locale instanceof LocaleEnum) {
            $this->locale = $locale;
        }
    }

    #[Gedmo\Translatable]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $title = null;

    #[Gedmo\Translatable]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
