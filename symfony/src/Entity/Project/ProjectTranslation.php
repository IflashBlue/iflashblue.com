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
use Symfony\Component\String\Slugger\AsciiSlugger;

#[ORM\Entity]
#[ORM\Table(name: '`project_translation`')]
#[ORM\UniqueConstraint(columns: ['locale', 'id'])]
#[ORM\HasLifecycleCallbacks]
class ProjectTranslation implements TranslatableInterface, EntityInterface
{
    use EntityTrait;
    use TranslatableTrait;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $slug = null;

    #[ORM\PreFlush]
    public function generateSlug(): void
    {
        /** @var string $title */
        $title = $this->title;
        $slugger = new AsciiSlugger();
        $this->slug = strtolower($slugger->slug($title)->toString());
    }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
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
