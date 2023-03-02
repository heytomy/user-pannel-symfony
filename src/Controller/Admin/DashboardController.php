<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

/**
 * Class DashboardController
 * @package App\Controller\Admin
 *
 * This class is responsible for managing the administration dashboard and menu.
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * DashboardController constructor.
     *
     * @param AdminUrlGenerator $adminUrlGenerator
     */
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ){
        
    }
    
    /**
     * Displays the administration dashboard.
     *
     * @Route("/admin", name="admin")
     * @return Response
     */
    #[Route('/admin', name: 'admin')]    
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

         // Generates the URL for the User CRUD controller.
        $url = $this->adminUrlGenerator->setController(UserCrudController::class)
        ->generateUrl();

        // Redirects the user to the User CRUD index page.
        return $this->redirect($url);
    }

        /**
     * Configures the dashboard settings.
     *
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard');
    }

      /**
     * Configures the menu items displayed in the administration dashboard.
     *
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Users', 'fa-solid fa-right-to-bracket', User::class);
    }
}
