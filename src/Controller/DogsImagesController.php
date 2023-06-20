<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DogsImagesController extends AbstractController
{
    #[Route('/dogs/images', name: 'app_dogs_images')]
    public function index(): Response
    {
        return $this->render('dogs_images/index.html.twig', [
            'controller_name' => 'DogsImagesController',
        ]);
    }
}