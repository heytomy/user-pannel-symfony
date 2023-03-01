<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ){
        
    }
    #[Route('/admin', name: 'admin')]    
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $url = $this->adminUrlGenerator->setController(UserCrudController::class)
        ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Pannel Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Users', 'fa-solid fa-right-to-bracket', User::class);
    }
}
