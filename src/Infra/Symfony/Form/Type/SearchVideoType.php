<?php

namespace Infra\Symfony\Form\Type;

use Infra\Symfony\Persistance\Doctrine\Entity\Event;
use Infra\Symfony\Persistance\Doctrine\Entity\Section;
use Infra\Symfony\Persistance\Doctrine\Entity\Video;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->setMethod('GET')
            ->add('sections', EntityType::class, [
                'class' => Section::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('section')
                        ->orderBy('section.id', 'ASC');
                },
                'attr' => ['class' => 'form-control'],
                'multiple' => false,
                'required' => false
            ])
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('event')
                        ->orderBy('event.id', 'ASC');
                },
                'attr' => ['class' => 'form-control'],
                'multiple' => false,
                'required' => false
            ])
            ->add('country', CountryType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Video::class
        ));
    }

    public function getBlockPrefix() {
        return '';
    }

    public function getName() {
        return '';
    }
}
