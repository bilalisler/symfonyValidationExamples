<?php


namespace App\Validator\Constraints;


use App\Schema\CreditCard2;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CreditCardControlValidator  extends ConstraintValidator
{
    /**
     * @param CreditCard2 $creditCard2Schema
     * @param Constraint $constraint
     */
    public function validate($creditCard2Schema, Constraint $constraint)
    {
        dump($creditCard2Schema);die;
        // TODO: credit card validations
        if (empty($creditCard2Schema->getCardNumber())) {
            $this->context->buildViolation($constraint->message)
                ->atPath('foo')
                ->addViolation();
        }
    }

}