<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Dog;
use App\Repository\OfferRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ApplicationFixtures extends Fixture implements DependentFixtureInterface
{
    protected $offerRepository;
    protected $userRepository;
    protected $dogRepository;

    public function __construct(OfferRepository $offerRepository, UserRepository $userRepository)
    {
        $this->offerRepository = $offerRepository;
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $users = $this->userRepository->findAll();
        $offers = $this->offerRepository->findAll();
        $dateTime = new \DateTime();

        // Creation of 2 Applications
        for ($i = 0; $i < 2; ++$i) {
            $application = new Application();
            // random offer
            $randomNumber = mt_rand(0, count($offers) - 1);
            $offer = $offers[$randomNumber];
            $application->setOffer($offer);
            // random user
            $randomNumber = mt_rand(0, count($users) - 1);
            $user = $users[$randomNumber];
            $breeder = $offer->getBreeder();
            $offerDogs = $offer->getDogs();
            // Check if user != breeder
            if ($user->getId() == $breeder->getId()) {
                ++$randomNumber;
                // check if new $randomNumber isset as key in $users
                if (!isset($users[$randomNumber])) {
                    $randomNumber -= 2;
                }
                $user = $users[$randomNumber];
            }
            //Check if offer contains dog
            if ($offerDogs->first()){
                $application->addDog($offerDogs->first());
            }
            $application->setUser($user);
            $application->setDateTime($dateTime);
            $manager->persist($application);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            OfferFixtures::class,
            DogFixtures::class,
        ];
    }
}
