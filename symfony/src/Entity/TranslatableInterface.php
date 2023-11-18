<?php

namespace App\Entity;

use App\Admin\Enum\LocaleEnum;
use Gedmo\Translatable\Translatable;

interface TranslatableInterface extends Translatable
{
    public function setTranslatableLocale(LocaleEnum $locale): void;

    public function getLocale(): LocaleEnum;

    public function setLocale(LocaleEnum $locale): void;
}
