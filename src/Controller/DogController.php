<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Form\DogFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DogController extends AbstractController
{
    #[Route('/dog', name: 'dog_index')]
    public function index(): Response
    {
        return $this->render('dog/index.html.twig', [
            'controller_name' => 'DogController',
        ]);
    }

    #[Route('/dog/new', name: 'dog_new')]
    public function newDog(?Dog $dog = null): Response
    {
        $dog = new Dog();
        $form = $this->createForm(DogFormType::class, $dog );

        return $this->render('dog/new.html.twig', [
            'form' => $form -> createView() ,
        ]);
    }   
}