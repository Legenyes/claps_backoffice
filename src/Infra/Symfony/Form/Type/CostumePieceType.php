<?php

namespace Infra\Symfony\Form\Type;

use Doctrine\ORM\EntityRepository;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesCostumePiece;
use Infra\Symfony\Persistance\Doctrine\Entity\ClothesPiece;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CostumePieceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('piece', EntityType::class, [
                'class' => ClothesPiece::class,
                'required' => true,
                'choice_label' => 'codeDisplayName',
                'query_builder' => fn(EntityRepository $er) => $er->createQueryBuilder('piece')
                    ->orderBy('piece.code', 'ASC'),
            ])
            ->add('isDefault')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClothesCostumePiece::class
        ]);
    }
}
