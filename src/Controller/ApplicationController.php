<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Message;
use App\Entity\Offer;
use App\Form\ApplicationFormType;
use App\Repository\ApplicationRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ApplicationController extends AbstractController
{
    #[Route('/repondre-annonce-{id}', name: 'application_make', requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_USER')]
    public function makeApplication(
        Request $request,
        OfferRepository $offerRepository,
        Offer $offer,
        ApplicationRepository $applicationRepository): Response
    {
        $user = $this->getUser();

        if ($user == $offer->getBreeder()) {
            $this->addFlash('danger', 'Vous ne pouvez pas répondre à votre propre annonce');

            return $this->redirectToRoute('offer_show', ['id' => $offer->getId()]);
        } else {
            $message = (new Message())->setIsSentByAdopter(true);
            $application = (new Application())
            ->setUser($user)
            ->setOffer($offer)
            ->addMessage($message);

            $form = $this->createForm(ApplicationFormType::class, $application);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $applicationRepository->save($application, true);
                $this->addFlash('success', 'Demande de renseignement envoyée');

                return $this->redirectToRoute('app_default');
            }

            return $this->render('application/application_make.html.twig', [
                'offer' => $offer,
                'form' => $form->createView(),
            ]);
        }
    }
}
