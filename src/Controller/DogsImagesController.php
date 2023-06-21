<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\DogsImagesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DogsImagesController extends AbstractController
{
    #[Route('/dogs/images', name: 'app_dogs_images')]
    public function index(): Response
    {
        $dogsImages = new Image();
        $form = $this->createForm(DogsImagesType::class, $dogsImages);
        return $this->render('dogs_images/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}