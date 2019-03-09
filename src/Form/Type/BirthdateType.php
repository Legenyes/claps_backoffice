<?php

namespace App\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BirthdateType extends DateType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        // Set the defaults from the DateTimeType we're extending from
        parent::configureOptions($resolver);

        // Override: Go back 20 years and add 20 years
        $resolver->setDefault('years', range(date('Y') - 100, date('Y')));

    }
}
