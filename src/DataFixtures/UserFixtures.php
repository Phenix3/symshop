<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
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
                ->setNewsletter(mt_rand(0, 1))
                ->setLastSeen($faker->dateTimeThisYear())
            ;
            $manager->persist($user);
            $this->addReference('user-' . $i, $user);
        }
        $manager->flush();
    }
}
