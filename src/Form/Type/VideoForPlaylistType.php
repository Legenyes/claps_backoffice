<?php

namespace App\Form\Type;

use App\Entity\PlaylistVideo;
use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\EasyAdminAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoForPlaylistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('video', EasyAdminAutocompleteType::class, array(
                    'class' => Video::class,
                    'label' => false
                )
            )
        ;
    }  

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => PlaylistVideo::class
        ));
    } 
}
