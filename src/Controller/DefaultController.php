<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\OfferRepository;
use App\Repository\BreederRepository;
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

    // @TODO Move to OfferController //
    #[Route('/nos-annonces', name: 'offers_list')]
    public function listOffers(OfferRepository $offerRepository): Response
    {
        $offers = $offerRepository->findAllOffers();
        return $this->render('offer/offers_list.html.twig', [
            'offers' => $offers,
        ]);
    }
} 
