<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ConstraintFullNameValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ConstraintFullName) {
            throw new UnexpectedTypeException($constraint, ConstraintFullName::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $items = explode(' ',$value);

        if(count($items) < 2){
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}