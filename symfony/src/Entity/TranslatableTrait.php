<?php

namespace App\Entity;

use App\Enum\LocaleEnum;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait TranslatableTrait
{
    #[Gedmo\Locale]
    #[ORM\Column(type: Types::STRING, enumType: LocaleEnum::class)]
    private LocaleEnum $locale = LocaleEnum::FR;

    public function setTranslatableLocale(LocaleEnum $locale): void
    {
        $this->locale = $locale;
    }

    public function getLocale(): LocaleEnum
    {
        return $this->locale;
    }

    public function setLocale(LocaleEnum $locale): void
    {
        $this->locale = $locale;
    }
}
