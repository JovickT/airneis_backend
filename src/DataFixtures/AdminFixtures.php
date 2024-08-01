<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $admin = new Admin();
        $admin->setPrenom('Admin')
              ->setNom('Admin')
              ->setEmail('admin@example.com')
              ->setRoles(['ROLE_ADMIN']);
        
        $password = $this->passwordHasher->hashPassword($admin, 'admin123');
        $admin->setPassword($password);

        $manager->persist($admin);
        $manager->flush();
    }
}
