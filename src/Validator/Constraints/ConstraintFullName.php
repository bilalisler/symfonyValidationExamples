<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintFullName extends Constraint
{
    public $message = 'The string "{{ string }}" is not full name';
}