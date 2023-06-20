<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\OfferRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    #[IsGranted('ROLE_USER')]
    public function showUser( OfferRepository $offerRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $offers = $offerRepository->findForBreeders($user);
//        dd($offers);



        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'offers' => $offers,
        ]);
    }
}
