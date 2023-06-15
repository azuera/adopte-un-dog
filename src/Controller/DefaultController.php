<?php

namespace App\Controller;

use App\Form\Filter;
use App\Form\FilterFormType;
use App\Repository\BreedRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\OfferRepository;
use App\Repository\BreederRepository;
use Symfony\Component\HttpFoundation\Request;
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
    public function listOffers(
        Request $request,
        Filter $filter, 
        OfferRepository $offerRepository, 
        PaginatorInterface $paginator): Response
    {
        $filter = new Filter();
        $form = $this->createForm(FilterFormType::class, $filter);
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
} 
