<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckCardType extends Constraint
{
    public $message = 'You cannot make transactions because the card ("{{ string }}") is not credit card';

    public function validatedBy()
    {
        return static::class.'Validator';
    }
}