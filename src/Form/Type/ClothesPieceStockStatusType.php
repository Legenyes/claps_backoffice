<?php

namespace App\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClothesPieceStockStatusType extends ChoiceType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

	    $resolver->setDefault('choices',[
            'Au stock' => 'STOCK',
            'En utilisation' => 'USED',
            'Déclassé' => 'DECLASSED'] );

    }
}
