<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Offer;
use App\Entity\Application;
use App\Form\ApplicationFormType;
use App\Repository\OfferRepository;
use App\Repository\ApplicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/repondre-annonce-{id}', name: 'application_make', requirements: ['id' => '\d+'])]
    public function makeApplication(OfferRepository $offerRepository, Offer $offer, ApplicationRepository $applicationRepository): Response
    {
        $user = $this->getUser();
        $message = (new Message())->setIsSentByAdopter(true);
        $application = (new Application())
            ->setUser($user)
            ->setOffer($offer)
            ->addMessage($message);
        $form = $this->createForm(ApplicationFormType::class, $application);

        if ($form->isSubmitted() && $form->isValid()) {
            $applicationRepository->save($application, true);
            $this->addFlash('success', 'Demande de renseignement envoyée');
            // return $this->redirectToRoute('app_default');
        }

        return $this->render('application/application_make.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }
}
