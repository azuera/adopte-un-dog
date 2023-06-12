<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\OfferRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    #[Route('/', name: 'app_default')]
    public function index(OfferRepository $offerRepository): Response
    {
        $offers = $offerRepository->findBy([ 'isClosed' => false ], ['dateTime' => 'DESC'], 5);
        return $this->render('default/index.html.twig', [
            'offers' => $offers,
        ]);
    }
} 
