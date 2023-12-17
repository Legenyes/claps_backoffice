<?php

declare(strict_types=1);

namespace Infra\Symfony\Form\Type;

use Infra\Symfony\Persistance\Doctrine\Entity\Address;
use Infra\Symfony\Persistance\Doctrine\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class MemberEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => new TranslatableMessage('order.status', ['%order_id%' => 32], 'store'),
                'help' => new TranslatableMessage('order.status', ['%order_id%' => 32], 'store'),
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 30]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'member.properties.lastname',
            ])
            ->add('birthdate', BirthdayType::class, [
                'label' => 'member.properties.birthdate',
            ])
            ->add('sex', ChoiceType::class, [
                'label' => new TranslatableMessage('order.status', ['%order_id%' => 32], 'store'),
                'help' => new TranslatableMessage('order.status', ['%order_id%' => 32], 'store'),
                'choices' => [
                    'sex.m' => 'M',
                    'sex.f' => 'F',
                ],
                'choice_label' => function ($choice, $key, $value) {
                    return new TranslatableMessage($key, false === $choice ? [] : ['%company%' => $value], 'store');
                },
            ])
            ->add('niss', TextType::class, [
                'label' => 'member.properties.niss',
                'required' => false,
            ])
            ->add('insurer', ChoiceType::class, [
                'choices' => [
                    'PartenaMut' => 'PARTENA',
                    'Mutualité Solidaris' => 'SOLIDARIS',
                    'Mutualité Chrétienne' => 'MC',
                    'Mutualité Neutre' => 'MN'
                ],
                'label' => 'member.properties.insurer',
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'member.properties.email',
            ])
            ->add('phone', TextType::class, [
                'label' => 'member.properties.phone',
                'required' => false,
            ])
            ->add('mobilePhone', TextType::class, [
                'label' => 'member.properties.mobilePhone',
            ])
            ->add('address', AddressType::class, [
                'data_class' => Address::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
