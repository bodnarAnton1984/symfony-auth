<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    protected $userPasswordEncoderInterface;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {
        $this->userPasswordEncoderInterface = $userPasswordEncoderInterface;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->addRole('ROLE_ADMIN');

        $user->setPassword($this->userPasswordEncoderInterface->encodePassword(
            $user, '123456'
        ));

        $user->setEmail('admin@mail.com');
        $user->setFirstname('admin');
        $user->setLastname('admin');
        $user->setStatus(1);

        $manager->persist($user);
        $manager->flush();
    }
}
