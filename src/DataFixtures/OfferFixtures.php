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
        $dateTime = new \DateTime() ;
        $breeders = $this->breederRepository->findAll();

        //Creation of 4 Offers
        for ( $i = 0; $i < 4; $i++){
            $offer = new Offer();
            $offer->setTitle($title);
            $offer->setDescription($description);
            $offer->setLocation($location);
            $dateTime->modify('-' . mt_rand(0,100) . 'minutes');
            $offer->setDateTime($dateTime);
            //adding 1 breeder
            $offer->setBreeder($breeders[$i]);
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
