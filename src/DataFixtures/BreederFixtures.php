<?php

namespace App\DataFixtures;

use App\Entity\Breeder;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class BreederFixtures extends Fixture
{
    protected UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        //Creation of 4 Breeder
        for ( $i = 0; $i < 4; $i++){
            $breeder = new Breeder();
            $breeder->setEmail('un-mail'.$i.'@mail.com');
            $password = $this->hasher->hashPassword($breeder, 'aze123');
            $breeder->setPassword($password);
            $breeder->setName('Eleveur' . $i);
            if ( $i%2 == 0){
                $breeder->setIsAdmin(true);
            }
            $manager->persist($breeder);
        }
        for ( $i = 0; $i < 4; $i++){
            $adopter = new User();
            $adopter->setEmail('un-autre-mail'.$i.'@mail.com');
            $password = $this->hasher->hashPassword($adopter, 'aze123');
            $adopter->setPassword($password);
            $adopter->setName('Eleveur' . $i);
            
            $manager->persist($adopter);
        }
        $manager->flush();
    }
}
