<?php

namespace App\Entity;

interface ImageInterface
{
    public function getImage(): ?string;

    public function setImage(?string $image): void;
}
