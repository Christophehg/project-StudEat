<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    // ...
    public function load(ObjectManager $manager)
    {
        $user = new User($this->hasher);
        $user->setUsername('admin')->setPassword("mohamed")->setPhone("1234567896")->setFirstName("Chris")->setLastName("Chevalier")->setEmail("chevalier@chris-freelance.com");

        $manager->persist($user);
        $manager->flush();
    }
}