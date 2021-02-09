<?php

namespace App\Controller;

use App\Form\CreditCardFormType;
use App\Schema\CreditCard;
use App\Schema\CreditCard2;
use App\Schema\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DefaultController extends AbstractController
{
    /**
     * Desc: validation basic usage
     *
     * Steps:
     *   - Constraint define
     *   - Custom Validation create
     *   - Group Based Validation
     *   - Custom validation service integration
     *
     * Documents:
     *  - https://symfony.com/doc/current/validation/custom_constraint.html#creating-the-constraint-class
     *
     * @Route("/example1", name="example1")
     *
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return Response
     */
    public function example1(ValidatorInterface $validator, Request $request): Response
    {
        $errors = [];
        if ($request->getMethod() === 'POST') {
            $creditCard = new CreditCard();
            $creditCard->setFullName($request->request->get('fullName'))
                ->setCardNumber($request->request->get('cardNumber'))
                ->setYear($request->request->get('year'))
                ->setMonth($request->request->get('month'))
                ->setCvv($request->request->get('cvv'));


            $errors = $validator->validate($creditCard);
//            $errors = $validator->validate($creditCard,null,['payment']);
        }

        return $this->render('default/example1.html.twig', [
            'errors' => $errors,
        ]);
    }

    /**
     * Desc: how to validate all class
     *
     * Steps:
     *   - all class validation not based property
     *
     * Document: https://symfony.com/doc/current/validation/custom_constraint.html#creating-the-constraint-class
     *
     * @Route("/example12", name="example12")
     *
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return Response
     */
    public function example12(ValidatorInterface $validator, Request $request): Response
    {
        $errors = [];
        if ($request->getMethod() === 'POST') {
            $creditCard = new CreditCard2();
            $creditCard->setFullName($request->request->get('fullName'))
                ->setCardNumber($request->request->get('cardNumber'))
                ->setYear($request->request->get('year'))
                ->setMonth($request->request->get('month'))
                ->setCvv($request->request->get('cvv'));


            $errors = $validator->validate($creditCard);
        }

        return $this->render('default/example1.html.twig', [
            'errors' => $errors,
        ]);
    }

    /**
     * Desc: validation basic usage without reference class
     *
     * @Route("/example2", name="example2")
     *
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return Response
     */
    public function example2(ValidatorInterface $validator, Request $request): Response
    {
        $errors = [];
        if ($request->getMethod() === 'POST') {
            $constraints = [
                'fullName' => [new NotBlank()],
                'cardNumber' => [new NotBlank()],
                'year' => [new NotBlank()],
                'month' => [new NotBlank()],
                'cvv' => [new NotBlank()],
            ];

            $errors = $validator->validate($request->request->all(), new Collection($constraints));
//            $errors = Validation::createValidator()->validate($request->request->all(), new Collection($constraints));
        }

        return $this->render('default/example2.html.twig', [
            'errors' => $errors,
        ]);
    }

    /**
     * Desc: method based constraint
     *
     * @Route("/example3", name="example3")
     *
     * @param ValidatorInterface $validator
     * @param Request $request
     * @return Response
     */
    public function example3(ValidatorInterface $validator, Request $request): Response
    {
        $errors = [];
        if ($request->getMethod() === 'POST') {
            $user = new User();
            $user->setFirstName($request->request->get('firstName'))
                ->setLastName($request->request->get('lastName'))
                ->setEmail($request->request->get('email'))
                ->setPassword($request->request->get('password'));

            $errors = $validator->validate($user);
        }

        return $this->render('default/example3.html.twig', [
            'errors' => $errors,
        ]);
    }

    /**
     * Documents:
     *   - https://symfony.com/doc/current/forms.html
     *   - https://symfony.com/doc/current/form/form_themes.html
     *
     * @Route("/example-form", name="example_form")
     *
     * @param Request $request
     * @return Response
     */
    public function exampleForm(Request $request): Response
    {
        $creditCard = new CreditCard();
        $creditCardFormType = $this->createForm(CreditCardFormType::class, $creditCard);
        $creditCardFormType->handleRequest($request);

        if ($creditCardFormType->isSubmitted() && $creditCardFormType->isValid()) {
            dump($creditCardFormType->getData());
            die;
        }

        return $this->render('default/example-form.html.twig', [
            'creditCardForm' => $creditCardFormType->createView(),
        ]);
    }

    /**
     * @Route("/example-option-resolver", name="example_option_resolver")
     *
     * Document: https://symfony.com/doc/current/components/options_resolver.html#usage
     *
     * @param Request $request
     * @return Response
     */
    public function exampleOptionResolver(Request $request): Response
    {
        $parameters = [
            'username' => 'bilalisler',
            'password' => 'TEST123',
            'birth_date' => '12'
//            'birth_date' => new \DateTime('')
        ];

        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'avatar' => 'avatar photo path'
        ]);

        $resolver->setRequired([
            'username',
            'password',
            'birth_date'
        ]);

        $resolver->setAllowedTypes('username', 'string');
        $resolver->setAllowedTypes('password', 'string');
        $resolver->setAllowedTypes('birth_date', 'DateTime');

       dump(
           $resolver->resolve($parameters)
       );
       die;
    }
}
