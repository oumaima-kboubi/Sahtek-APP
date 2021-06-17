<?php

namespace App\Controller\Admin;

use App\Entity\Belong;
use App\Entity\CareTakerOrder;
use App\Entity\Category;
use App\Entity\City;
use App\Entity\Drug;
use App\Entity\DrugOrder;
use App\Entity\Entreprise;
use App\Entity\Money;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     *
     */
    public function index(): Response
    {
       // return parent::index();
// redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);
//
        return $this->redirect($routeBuilder->setController(DrugCrudController::class)->generateUrl());
//
//        // you can also redirect to different pages depending on the current user
//        if ('jane' === $this->getUser()->getUsername()) {
//            return $this->redirect('...');
//        }
//
//        // you can also render some template to display a proper Dashboard
//        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
//        return $this->render('@EasyAdmin/page/content.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SahtekAPP');
    }

    public function configureMenuItems(): iterable
    {
//        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
//         yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
         yield MenuItem::section('SPACES');
         yield MenuItem::linkToCrud('Drug','fas fa-tablets',Drug::class);
         yield MenuItem::linkToCrud('Entreprise','fas fa-building',Entreprise::class);
         yield MenuItem::linkToCrud('DrugOrder','fa fa-list',DrugOrder::class);
         yield MenuItem::linkToCrud('Money','fa fa-dollar-sign',Money::class);
         yield MenuItem::linkToCrud('Category','fa fa-file-medical',Category::class);
         yield MenuItem::linkToCrud('List: drugs/pharmacies','fa fa-clipboard-list',Belong::class);
         yield MenuItem::linkToCrud('List: order/caretaker','fa fa-user-nurse',CareTakerOrder::class);
         yield MenuItem::section('Users');
         yield MenuItem::linkToCrud('User','fa fa-user',User::class);
         yield MenuItem::linkToCrud('City','fa fa-map-marked-alt',City::class);
        yield MenuItem::section('GO TO');
         yield MenuItem::linkToRoute('Lobby','fa fa-arrow-circle-right','routing.homeIn');
         yield MenuItem::linkToLogout('Logout','fa fa-sign-out-alt');

    }
}
