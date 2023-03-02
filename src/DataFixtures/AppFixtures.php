<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory as Faker;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        // Inject the user password hasher
        $this->passwordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Create a Faker instance to generate fake data
        $faker = Faker::create();

        // Create an admin user
        $user = new User();
        $user
        ->setEmail('nisi.thomas@outlook.fr')
        ->setRoles(['ROLE_ADMIN'])
        ;

        // Hash the password using the password hasher
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'yufDZiA3hmp3Ap7');
        $user->setPassword($hashedPassword);

        // Persist the admin user object
        $manager->persist($user);

        // Create 20 users
        for ($i=0; $i < 20; $i++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setRoles(['ROLE_USER'])
            ;
            
            // Hash the password using the password hasher
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'password');
            $user->setPassword($hashedPassword);
            // Persist user
            $manager->persist($user);

        }
        // Flush all the changes to the database
        $manager->flush();
    }
}
