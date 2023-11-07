<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait TranslationTrait
{
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    protected Collection $translations;

    public function addTranslation(TranslatableInterface $trans): void
    {
        if (!$this->translations->contains($trans)) {
            $this->translations->set($trans->getLocale()->value, $trans);
        }
    }

    public function getTranslation(string $locale): ?TranslatableInterface
    {
        /** @var TranslatableInterface|null $trans */
        $trans = $this->translations->get($locale);

        return $trans;
    }

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function setTranslations(Collection $translations): void
    {
        $this->translations = $translations;
    }
}
