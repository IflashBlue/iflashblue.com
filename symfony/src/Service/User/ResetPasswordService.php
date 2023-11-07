<?php

namespace App\Service\User;

use App\Entity\User\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ResetPasswordService
{
    public function __construct(
        readonly private UserRepository $userRepository,
        readonly private UserPasswordHasherInterface $hasher,
    ) {
    }

    public function reset(string $plainPassword, User $user): void
    {
        $hashedPassword = $this->hasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);

        $this->userRepository->add($user, true);
    }
}
