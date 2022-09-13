<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->encoder = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
            $user->setEmail('admin@ikla.com');
            $user->setPassword($this->encoder->hashPassword($user, "pass"));
            $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
            $user->setNom('Pasquier');
            $user->setPrenom('Jennifer');
        

                $manager->persist($user);
                $manager->flush();
            }

    
    public static function getGroups(): array
    {
        return ['group1'];
    }
}
