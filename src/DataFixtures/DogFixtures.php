<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DogFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $name ='tobi';
        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
        $history = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
        $sociability = 'ok chat';

    }
}