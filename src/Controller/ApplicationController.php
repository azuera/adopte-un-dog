<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Breeder;
use App\Entity\Message;
use App\Entity\Offer;
use App\Form\ApplicationFormType;
use App\Form\MessageType;
use App\Repository\ApplicationRepository;
use App\Repository\MessageRepository;
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
        ApplicationRepository $applicationRepository
    ): Response {
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

    #[Route('application/{id}/reponse', name: 'reponse_message', requirements: ['id' => '\d+'])]
    public function message(
        Request $request,
        MessageRepository $messageRepository,
        Application $application
    ): Response {
        $message = new Message();
        $message->setDateTime(new \DateTime());
        $message->setApplication($application);
        $message->setIsSentByAdopter(!$this->getUser() instanceof Breeder);
        $form = $this->createForm(MessageType::class, $message, [
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $messageRepository->save($message, true);

            $this->addFlash('success', 'Message envoyé');

            return $this->redirectToRoute('reponse_message', ['id' => $application->getId()]);
        }

        return $this->render('application/conversation.html.twig', [
            'form' => $form->createView(),
            'application' => $application,
        ]);
    }
}
