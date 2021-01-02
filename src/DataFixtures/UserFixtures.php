<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private const USER_NAMES = array("ZDENEK", "EDUARD", "JOHNDOE");

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        foreach (self::USER_NAMES as $username) {
            $user = new User();

            $user->setUsername($username);
            $user->setPassword($this->passwordEncoder->encodePassword($user, "development"));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
