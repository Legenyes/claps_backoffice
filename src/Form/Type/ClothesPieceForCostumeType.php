<?php

namespace App\Form\Type;

use App\Entity\ClothesPiece;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\EasyAdminAutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClothesPieceForCostumeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('piece', EasyAdminAutocompleteType::class, array(
                    'class' => ClothesPiece::class
                )
            )
        ;
    }  

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\ClothesCostumePiece'
        ));
    } 
}
