<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class AtLeastOneCharacterTypeValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof AtLeastOneCharacterType) {
            throw new UnexpectedTypeException($constraint, AtLeastOneCharacterType::class);
        }

        if (!is_array($value)) {
            return;
        }

        $hasAtLeastOne = ($value['useUppercase'] ?? false)
            || ($value['useLowercase'] ?? false)
            || ($value['useNumbers'] ?? false);

        if (!$hasAtLeastOne) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
