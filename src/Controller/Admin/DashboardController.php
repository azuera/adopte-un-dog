<?php

namespace App\Controller\Admin;

use App\Entity\Application;
use App\Entity\Breed;
use App\Entity\Breeder;
use App\Entity\Department;
use App\Entity\Dog;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Adopte Un Dog');


    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Applications', 'fas fa-list', Application::class);
        yield MenuItem::linkToCrud('Breeds', 'fas fa-list', Breed::class);
        yield MenuItem::linkToCrud('Breeders', 'fas fa-list', Breeder::class);
        yield MenuItem::linkToCrud('Departments', 'fas fa-list', Department::class);
        yield MenuItem::linkToCrud('Dogs', 'fas fa-list', Dog::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class);
    }
}