<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorldUpload extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach (UserFixtures::USER_NAMES as $username) {
            $worldUpload = new \App\Entity\WorldUpload();
            $worldUpload->setWorldData(array());
            /** @noinspection PhpParamsInspection */
            $worldUpload->setAuthor($this->getReference("user-".$username));

            $manager->persist($worldUpload);
        }

        $manager->flush();
    }
}
