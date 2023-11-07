<?php

namespace App\Entity\Project;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\TranslatableInterface;
use App\Entity\TranslatableTrait;
use App\Enum\LocaleEnum;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: '`category_translation`')]
#[ORM\UniqueConstraint(columns: ['locale', 'id'])]
class CategoryTranslation implements TranslatableInterface, EntityInterface
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }
}
