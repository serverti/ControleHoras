<?php

namespace App\DataFixtures;

use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {

        $newUserAdmin = $this->userRepository->newUserAdmin('Admin123');
        $newUserAdmin->setEmail('admin@admin.com.br');

        $manager->persist($newUserAdmin);

        $manager->flush();
    }
}
