<?php

namespace App\Form;

use App\Schema\CreditCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreditCardFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('fullName',TextType::class,[
                'help' => 'Full name as displayed on card',
                'label' => 'Name on card',
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('cardNumber')
            ->add('year')
            ->add('month')
            ->add('cvv',null,[
                'help' => 'Cvv is a number with 3 digit as displayed on back of card',
            ])
//            ->add('password',PasswordType::class,[
//                'mapped' => false,
//                'label' => 'Card Password',
//                'constraints' => [
//                    new NotBlank(),
//                    new Length(['min' => 3]),
//                ],
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreditCard::class,
            'block_prefix' => '',
//            'validation_groups' => 'debit',
//            'validation_groups' => [
//                'payment',
//                'debit'
//            ]
        'csrf_protection' => true,
        'csrf_field_name' => '_csrf_token',
        'csrf_token_id' => 'test_token'
        ]);
    }
}
