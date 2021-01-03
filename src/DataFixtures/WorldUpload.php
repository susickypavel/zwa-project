<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorldUpload extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $worldUpload = new \App\Entity\WorldUpload();
        $worldUpload->setWorldData(array());

        $manager->persist($worldUpload);

        $manager->flush();
    }
}
