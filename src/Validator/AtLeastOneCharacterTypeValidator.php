<?php

namespace App\Validator;

use App\Dto\PasswordGeneratorRequest;
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

        if (!$value instanceof PasswordGeneratorRequest) {
            return;
        }

        $hasAtLeastOne = $value->useUppercase
            || $value->useLowercase
            || $value->useNumbers;

        if (!$hasAtLeastOne) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
