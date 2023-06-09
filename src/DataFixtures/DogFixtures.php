<?php

namespace App\DataFixtures;

use App\Entity\Dog;
use App\Repository\BreedRepository;
use App\Repository\OfferRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DogFixtures extends Fixture implements DependentFixtureInterface
{
    private OfferRepository $offerRepository;
    private BreedRepository $breedRepository;

    public function __construct(OfferRepository $offerRepository, breedRepository $breedRepository)
    {
        $this -> offerRepository = $offerRepository;
        $this -> breedRepository = $breedRepository;
    }

    public function load(ObjectManager $manager)
    {
        $name = 'tobi';
        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
        $history = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
        $sociability = 'ok chat';
        $offers = $this -> offerRepository -> findAll();
        $breeds = $this -> breedRepository -> findAll();

        for ($i = 0; $i < 4; $i++) {
            $dog = new Dog();
            $dog -> setName($name . $i);
            $dog -> setDescription($description);
            $dog -> setHistory($history);
            $dog -> setSociability($sociability);
            $dog -> setOffer($offers[$i]);
            $dog -> addBreed($breeds[mt_rand(0, count($breeds) - 1)]);
            $dog -> addBreed($breeds[mt_rand(0, count($breeds) - 1)]);
            $manager -> persist($dog);
        }
        $manager -> flush();
    }

    public function getDependencies()
    {
        return [
            BreedFixtures::class,
            OfferFixtures::class,
        ];
    }
}