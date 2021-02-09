<?php


namespace App\Validator\Constraints;


use App\Service\BinListService;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CheckCardTypeValidator extends ConstraintValidator
{
    private $service;

    /**
     * Desc: Validasyon Sınıfımızı servis olarak tanımlamak için;
     *       services.ymldaki tag'i(validator.constraint_validator) eklemeliyiz
     *
     * CheckCardTypeValidator constructor.
     * @param BinListService $service
     */
    public function __construct(BinListService $service)
    {
        $this->service = $service;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof CheckCardType) {
            throw new UnexpectedTypeException($constraint, CheckCardType::class);
        }

//        vendor/symfony/validator/Context/ExecutionContextInterface.php
//        $violations = $this->context->getValidator()->validate($value, new Length(['min' => 3]));
//        if (count($violations) > 0) {}

        // TODO: may check empty
        $cardNumber = substr($value, 0, 8);

        $cardDetail = json_decode($this->service->cardDetail($cardNumber), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->context->buildViolation(sprintf('Card Number Validation Error: %s', json_last_error_msg()))->addViolation();
        }

        if ($cardDetail['type'] === 'debit') {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $cardNumber)
                ->addViolation();
        }
    }
}