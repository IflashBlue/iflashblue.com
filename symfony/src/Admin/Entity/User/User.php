<?php

namespace App\Admin\Entity\User;

use App\Entity\EntityInterface;
use App\Entity\EntityTrait;
use App\Entity\ImageInterface;
use App\Entity\ImageTrait;
use App\Entity\TranslatableInterface;
use App\Entity\TranslatableTrait;
use App\Entity\TranslationInterface;
use App\Entity\TranslationTrait;
use App\Admin\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[Gedmo\TranslationEntity(class: UserTranslation::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface, TranslationInterface, EntityInterface
{
    use EntityTrait;
    use TranslationTrait {
        TranslationTrait::__construct as private __translationConstruct;
    }

    public function __construct()
    {
        $this->__translationConstruct();
    }

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column(unique: true, nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?string $lastname = null;

    #[ORM\Column]
    private ?string $firstname = null;

    /**
     * @var array<string>
     */
    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?string $image = null;

    #[ORM\ManyToMany(
        targetEntity: UserTranslation::class,
        cascade: ['persist', 'remove', 'merge'],
        fetch: 'EAGER',
        orphanRemoval: true,
        indexBy: 'locale')
    ]
    #[ORM\JoinTable(name: 'user_translations')]
    #[ORM\JoinColumn(name: 'object_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'translation_id', referencedColumnName: 'id', unique: true, onDelete: 'CASCADE')]
    protected Collection $translations;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array<string> $roles
     *
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
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
