<?php

namespace App\Admin\Entity\Article;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\TranslationInterface;
use App\Entity\TranslationTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: '`article_image`')]
class ArticleImage
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
