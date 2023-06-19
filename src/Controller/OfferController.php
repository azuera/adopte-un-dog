<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OfferRepository;

class OfferController extends AbstractController
{
    #[Route('/offer/{id}', name: 'app_offer', requirements: ['id' => '\d+'])]
    public function showOffer(OfferRepository $offerRepository, int $id): Response
    {
        $offer = $offerRepository->find($id);
        // var_dump($offer);
        return $this->render('offer/offer.html.twig', [
            'offer' => $offer,
        ]);
    }
}