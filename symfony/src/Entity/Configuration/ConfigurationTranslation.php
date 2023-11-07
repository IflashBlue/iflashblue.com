<?php

namespace App\Entity\Configuration;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\TranslatableInterface;
use App\Entity\TranslatableTrait;
use App\Enum\LocaleEnum;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: '`configuration_translation`')]
#[ORM\UniqueConstraint(columns: ['locale', 'id'])]
class ConfigurationTranslation implements TranslatableInterface, EntityInterface
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
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $city = null;

    #[Gedmo\Translatable]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $email = null;

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
}
