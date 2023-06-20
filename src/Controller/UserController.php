<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\OfferRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'app_user', requirements: ['id' => '\d+'])]
    public function showUser(UserRepository $userRepository, OfferRepository $offerRepository, int $id, User $user): Response
    {
        $users = $userRepository->find($id);
        $offers = $offerRepository->findForBreeders($user);
//        dd($offers);



        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $users,
            'offers' => $offers,
        ]);
    }
}
