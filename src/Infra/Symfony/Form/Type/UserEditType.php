<?php

declare(strict_types=1);

namespace Infra\Symfony\Form\Type;

use Infra\Symfony\Persistance\Doctrine\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'user.properties.email',
                'disabled' => true,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'user.properties.firstname',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'user.properties.lastname',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
