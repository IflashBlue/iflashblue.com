<?php

namespace App\Entity\Project;

use App\Entity\EntityTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: '`project_image`')]
class ProjectImage
{
    use EntityTrait;

    #[ORM\Column(name: '`order`', type: Types::INTEGER, nullable: true)]
    private ?int $order = null;

    #[ORM\Column(name: '`image`', type: Types::TEXT, nullable: false)]
    private string $image;

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): void
    {
        $this->order = $order;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }
}
