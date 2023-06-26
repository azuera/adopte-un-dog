<?php
namespace App\Controller;

use App\Entity\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConversationController extends AbstractController
{
    #[Route('/conversation-{id}', name: 'app_conversation')]
    public function index(Application $application): Response
    {
        return $this->render('conversation/index.html.twig', [
            'application' => $application,
        ]);
    }
}