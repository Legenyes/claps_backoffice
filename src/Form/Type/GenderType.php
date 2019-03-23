<?php

namespace App\Form\Type;

use App\Entity\ClothesPiece;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenderType extends ChoiceType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('choices', ClothesPiece::getGenders() );
        $resolver->setDefault('multiple', true );
        $resolver->setDefault('expanded', true );

    }
}
