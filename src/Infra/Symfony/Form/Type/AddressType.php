<?php

declare(strict_types=1);

namespace Infra\Symfony\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('street', TextType::class, [
                'label' => 'address.properties.street',
            ])
            ->add('streetNumber', TextType::class, [
                'label' => 'address.properties.streetNumber',
            ])
            ->add('streetBox', TextType::class, [
                'label' => 'address.properties.streetBox',
                'required' => false,
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'address.properties.zipCode',
            ])
            ->add('city', TextType::class, [
                'label' => 'address.properties.city',
            ])
            ->add('country', CountryType::class, [
                'label' => 'address.properties.country',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AddressType::class,
        ]);
    }
}
