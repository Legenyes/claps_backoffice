<?php

declare(strict_types=1);

namespace Infra\Symfony\Form\Type;

use Infra\Symfony\Persistance\Doctrine\Entity\Address;
use Infra\Symfony\Persistance\Doctrine\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'member.properties.firstname',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'member.properties.lastname',
            ])
            ->add('birthdate', BirthdayType::class, [
                'label' => 'member.properties.birthdate',
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => [ 'Male' => 'M', 'Female' => 'F'],
                'label' => 'member.properties.sex',
            ])
            ->add('niss', TextType::class, [
                'label' => 'member.properties.niss',
                'required' => false,
            ])
            ->add('insurer', ChoiceType::class, [
                'choices' => [
                    'PartenaMut' => 'PARTENA',
                    'Mutualité Solidaris' => 'SOLIDARIS',
                    'Mutualité Chrétienne' => 'MC'
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
