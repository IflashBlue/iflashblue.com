<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ImageTrait
{
    #[ORM\Column]
    private ?string $image = null;

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }
}
