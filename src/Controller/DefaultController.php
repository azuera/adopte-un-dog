<?php

namespace App\Controller;

use App\Repository\BreederRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(OfferRepository $offerRepository, BreederRepository $breederRepository): Response
    {
        $offers = $offerRepository->findForHome();
        $breeders = $breederRepository->findForHome();

        return $this->render('default/index.html.twig', [
            'offers' => $offers,
            'breeders' => $breeders,
        ]);
    }
}
