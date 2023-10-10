<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $encoder)
    {
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i <= 20; $i++) {
            $user = new User();
            $user->setUsername($faker->userName)
                ->setEmail($faker->safeEmail)
                ->setPassword($this->encoder->encodePassword($user, '123456'))
                ->setIsVerified(true)
                ->setNewsletter(random_int(0, 1))
                ->setLastSeen($faker->dateTimeThisYear())
            ;
            $manager->persist($user);
            $this->addReference('user-' . $i, $user);
        }
        $manager->flush();
    }
}
