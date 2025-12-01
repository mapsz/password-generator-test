<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class AtLeastOneCharacterType extends Constraint
{
    public string $message = 'Choose at least one character type.';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
