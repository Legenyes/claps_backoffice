<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('street')
            ->add('streetNumber')
            ->add('streetBox')
            ->add('zipCode')
            ->add('city')
            ->add('country', CountryType::class, [
                'preferred_choices' => [ 'BE', 'FR', 'NL'], 
            ])
        ;
    }  

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Address'
        ));
    } 
}
