<?php

namespace App\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsurerType extends ChoiceType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

	$resolver->setDefault('choices',[
            'PartenaMut' => 'PARTENA', 
            'Mutualité Solidaris' => 'SOLIDARIS',
            'Mutualité Chrétienne' => 'MC'] );

    }
}
