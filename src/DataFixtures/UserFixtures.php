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
      // On configure dans quelles langues nous voulons nos données
      $faker = Faker\Factory::create('fr_FR');

      // on créé 10 users
      //for ($i = 0; $i < 1; $i++) {
          $user = new User();
          $user->setEmail('admin@example.com');
          $user->setPassword($this->passwordEncoder->encodePassword(
              $user,
              'admin'
          ));
          $user->setRoles(['ROLE_SUPER_ADMIN','ROLE_ADMIN', 'ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH' ]);
          $manager->persist($user);
      //}

      $manager->flush();

  }
}
