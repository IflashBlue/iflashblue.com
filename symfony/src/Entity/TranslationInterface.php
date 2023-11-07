<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;

interface TranslationInterface
{
    public function addTranslation(TranslatableInterface $trans): void;

    public function getTranslations(): Collection;

    public function getTranslation(string $locale): ?TranslatableInterface;

    public function setTranslations(Collection $translations): void;
}
