<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use App\Repository\BreederRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    protected $breederRepository;

    public function __construct(BreederRepository $breederRepository)
    {
        $this->breederRepository = $breederRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $title = 'Nos beaux toutous';
        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce luctus neque justo, id vulputate velit malesuada in. Donec vulputate ipsum vitae orci vestibulum, et tempus orci hendrerit.';
        $location = 'Lyon';

        $newDate = new \DateTime() ;
        $breeders = $this->breederRepository->findAll();
        
        //Creation of 6 Offers
        for ( $i = 0; $i < 6; $i++){
            $dateTime = (clone $newDate)->modify('-' . mt_rand(0, 3) . 'day');
            $updateTime = (clone $dateTime)->modify('+' . mt_rand(1, 3) . 'day');
            // dd($dateTime, $updateTime);

            $offer = new Offer();
            $offer->setTitle($title);
            $offer->setDescription($description);
            $offer->setLocation($location);

            $offer->setDateTime($dateTime);
            $offer->setUpdatedTime($updateTime);
            //adding 1 breeder
            $offer->setBreeder($breeders[mt_rand(0, count($breeders) - 1)]);
            $manager->persist($offer);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
