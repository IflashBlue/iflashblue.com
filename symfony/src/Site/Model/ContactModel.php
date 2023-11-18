<?php

namespace App\Site\Model;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactModel
{
    #[NotBlank]
    public string $name;

    #[NotBlank]
    #[Email]
    public string $email;

    #[NotBlank]
    #[Length(max: 2000)]
    public string $message;
}
