<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Offer;
use App\Entity\Application;
use App\Form\ApplicationFormType;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/repondre-annonce-{id}', name: 'application_make', requirements: ['id' => '\d+'])]
    public function makeApplication(OfferRepository $offerRepository, Offer $offer): Response
    {
        $user = $this->getUser();
        $message = new Message();
        $application = (new Application())
            ->setUser($user)
            ->setOffer($offer)
            ->addMessage($message);
        $form = $this->createForm(ApplicationFormType::class, $application);
        return $this->render('application/application_make.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }
}
