<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
          $user = new User();
          $user->setEmail('admin@example.com');
        $user->setFirstName('Mhemed');
        $user->setLastName('Ben Henda');
        $user->setMobile('0622215063');
        $user->setAddress('Paris');


        $user->setZipCode('95000');
        $user->setCity('city');
        $user->setCountry('France');
        $user->setPosition('Developer');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));
        $user->setRoles(['ROLE_SUPER_ADMIN','ROLE_ADMIN', 'ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH' ]);
        $manager->persist($user);


        $manager->flush();
    }
}
