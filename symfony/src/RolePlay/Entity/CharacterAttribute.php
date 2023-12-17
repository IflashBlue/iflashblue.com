<?php

namespace App\RolePlay\Entity;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\TranslationTrait;
use App\RolePlay\Repository\CharacterAttributeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CharacterAttributeRepository::class)]
#[ORM\Table(name: '`role_play_character_attribute`')]
#[Gedmo\TranslationEntity(class: CharacterAttributeTranslation::class)]
class CharacterAttribute implements EntityInterface
{
    use EntityTrait;

    use TranslationTrait {
        TranslationTrait::__construct as private __translationConstruct;
    }
    public function __construct()
    {
        $this->__translationConstruct();
    }

    #[ORM\Column(name: '`type`', type: Types::STRING, length: 255, nullable: false)]
    private ?string $type = null;
    #[ORM\Column(name: '`link`', type: Types::TEXT, nullable: true)]
    private ?string $link = null;
    #[ORM\Column(name: '`used`', type: Types::INTEGER, nullable: true)]
    private ?int $used = 1;
    #[ORM\Column(name: '`quantity`', type: Types::INTEGER, nullable: true)]
    private ?int $quantity = 1;
    #[ORM\Column(name: '`diceRoll`', type: Types::INTEGER, nullable: true)]
    private ?int $diceRoll = 1;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): void
    {
        $this->link = $link;
    }

    public function getUsed(): ?int
    {
        return $this->used;
    }

    public function setUsed(?int $used): void
    {
        $this->used = $used;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getDiceRoll(): ?int
    {
        return $this->diceRoll;
    }

    public function setDiceRoll(?int $diceRoll): void
    {
        $this->diceRoll = $diceRoll;
    }

}