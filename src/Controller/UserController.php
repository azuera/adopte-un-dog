<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'app_user', requirements: ['id' => '\d+'])]
    public function showUser(UserRepository $userRepository, OfferRepository $offerRepository, int $id): Response
    {
        $user = $userRepository->find($id);
        $offer = $offerRepository->find($id);
        dd($offer);
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'offer' => $offer,
        ]);
    }
}
