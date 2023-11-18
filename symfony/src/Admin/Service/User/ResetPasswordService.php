<?php

namespace App\Admin\Service\User;

use App\Admin\Entity\User\User;
use App\Admin\Repository\UserRepository;
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
