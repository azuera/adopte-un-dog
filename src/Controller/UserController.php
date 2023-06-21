<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ApplicationRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    #[IsGranted('ROLE_USER')]
    public function showUser( OfferRepository $offerRepository ,ApplicationRepository $applicationRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $offers = $offerRepository->findForBreeders($user);
        $applications = $applicationRepository->findUserApplications($user);
//        dd($applications);



        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'offers' => $offers,
            'applications' => $applications,
        ]);
    }
}
