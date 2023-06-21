<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Form\DogFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OfferRepository;

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
    public function newDog(Request $request, EntityManagerInterface $em, ?Dog $dog = null, OfferRepository $offerRepository): Response
    {
        $offer = $offerRepository->find(1);
        $dog = new Dog();
        $dog->setOffer($offer);
        $form = $this->createForm(DogFormType::class, $dog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dog);
            $em->flush();
            return $this->redirectToRoute('app_default');
        }

        return $this->render('dog/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}