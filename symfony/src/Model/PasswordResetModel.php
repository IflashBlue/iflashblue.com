<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints\NotBlank;

class PasswordResetModel
{
    #[NotBlank]
    public string $password;
}
