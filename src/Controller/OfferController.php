<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\Filter;
use App\Form\FilterFormType;
use App\Form\OfferFormType;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class OfferController extends AbstractController
{
    #[Route('/annonce/{id}', name: 'offer_show', requirements: ['id' => '\d+'])]
    public function showOffer(Offer $offer): Response
    {
        return $this->render('offer/offer.html.twig', [
            'offer' => $offer,
        ]);
    }

    #[Route('/nos-annonces', name: 'offers_list')]
    public function listOffers(
        Request $request,
        Filter $filter,
        OfferRepository $offerRepository,
        PaginatorInterface $paginator): Response
    {
        $filter = new Filter();
        $form = $this->createForm(FilterFormType::class, $filter, ['method' => 'GET']);
        $form->handleRequest($request);

        $offers = $offerRepository->findAllOffers($filter);
        $offers = $paginator->paginate(
            $offers,
            $request->query->getInt('page', 1),
            2
        );

        return $this->render('offer/offers_list.html.twig', [
            'filterForm' => $form->createView(),
            'offers' => $offers,
        ]);
    }

    #[Route('/nouvelle-annonce', name: 'offer_new')]
    #[Route('/modifier-annonce/{id}', name: 'offer_change', requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_BREEDER')]
    public function manageOffer(
        Request $request,
        EntityManagerInterface $entityManager,
        Offer $offer = null): Response
    {
        $user = $this->getUser();

        if (is_null($offer)) {
            $offer = (new Offer())
            ->setBreeder($user);
        } elseif ($offer->getBreeder() != $user) {
            throw $this->createAccessDeniedException('NOPE');
        }

        $form = $this->createForm(OfferFormType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($offer);
            $entityManager->flush();

            if ($offer->isIsClosed()) {
                $this->addFlash('danger', 'Annonce fermée');
            } else {
                $this->addFlash('sucess', 'Annonce postée');
            }

            return $this->redirectToRoute('app_default');
        }

        return $this->render('offer/offer_management.html.twig', [
            'form' => $form->createView(),
            'offer' => $offer,
        ]);
    }
}
