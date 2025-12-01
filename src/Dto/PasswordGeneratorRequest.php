<?php

namespace App\Dto;

use App\Validator\AtLeastOneCharacterType;
use Symfony\Component\Validator\Constraints as Assert;

#[AtLeastOneCharacterType]
class PasswordGeneratorRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Range(min: 8, max: 64)]
        public int $length = 12,

        public bool $useUppercase = true,

        public bool $useLowercase = true,

        public bool $useNumbers = true,
    ) {
    }
}
