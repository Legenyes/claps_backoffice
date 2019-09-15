<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("sebastien@leveque.eu");
        $user->addRole('ROLE_ADMIN');
        $password = $this->encoder->encodePassword($user, 'seb123');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }

}