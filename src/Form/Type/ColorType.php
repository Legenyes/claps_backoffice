<?php

namespace App\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ColorType extends \Symfony\Component\Form\Extension\Core\Type\ColorType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

    }
}
