<?php

namespace App\Controller;

use App\Form\Filter;
use App\Form\FilterFormType;
use App\Form\OfferFormType;
use App\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\OfferRepository;

class OfferController extends AbstractController
{
    #[Route('/offer/{id}', name: 'offer_show', requirements: ['id' => '\d+'])]
    public function showOffer(OfferRepository $offerRepository, int $id): Response
    {
        $offer = $offerRepository->find($id);
        // var_dump($offer);
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
        $form = $this->createForm(FilterFormType::class, $filter,['method' => 'GET',]);
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

    #[Route("/nouvelle-offre", name: "offer_new")]
    #[Route("/modifier-offre/{id}", name: "offer_change", requirements: ['id' => '\d+'])]
    public function manageOffer(?Offer $offer = null): Response
    {
        if(is_null($offer)){
            $offer = new Offer();
        }
        $form = $this->createForm(OfferFormType::class, $offer);
        return $this->render('offer/offer_management.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}