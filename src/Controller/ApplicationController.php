<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/repondre-annonce-{id}', name: 'application_make', requirements: ['id' => '\d+'])]
    public function makeApplication(OfferRepository $offerRepository, int $id): Response
    {
        $offer = $offerRepository->find($id);
        return $this->render('application/application_make.html.twig', [
            'offer' => $offer,
        ]);
    }
}
