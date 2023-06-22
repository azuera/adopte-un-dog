<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\DogsImagesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DogsImagesController extends AbstractController
{
    #[Route('/dogs/images', name: 'app_dogs_images')]
    public function newImage(Request $request, EntityManagerInterface $em): Response
    {
        $dogsImages = new Image();
        $form = $this->createForm(DogsImagesType::class, $dogsImages);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dogsImages);
            $em->flush();
        }

        return $this->render('dogs_images/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}