<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DepartmentFixtures extends Fixture
{
    private DecoderInterface $decoder;

    public function __construct(DecoderInterface $decoder)
    {
        $this->decoder=$decoder;
    }

    public function load(ObjectManager $manager)
    {
        $departments = $this->decoder->decode(
            file_get_contents(__DIR__.'/../../ressources/departements-france.csv'),
            'csv'
        );

        foreach ($departments as $department){
            $dept= new Department();
            $dept->setName($department["nom_departement"]);
            $dept->setNumber($department["code_departement"]);
            $manager->persist($dept);
        }
        $manager ->flush();
    }
}