<?php

namespace App\Form\Type;

use App\Entity\Member;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MemberBraineType extends AbstractType
{
    /** @var TokenStorageInterface $tokenStorage */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $tokenStorage = $this->tokenStorage;
        $resolver->setDefaults(array(
            'class' => Member::class,
            'query_builder' => function(EntityRepository $er) use ( $tokenStorage ) {
                return $er->filterByParentUser($tokenStorage->getToken()->getUser());
            }
        ));

        parent::configureOptions($resolver);
    }

    public function getParent()
    {
        return EntityType::class;
    }
}
