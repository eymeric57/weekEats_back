<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Ingredient;
use App\Entity\IngredientMeasurements;
use App\Entity\Meal;
use App\Entity\MealIngredient;
use App\Entity\Type;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator) {}
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator

            ->setController(UserCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }



    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Html');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('Type de repas', 'fa-regular fa-calendar', Type::class);


        yield MenuItem::subMenu('Gestion des ingredients', "fa-solid fa-carrot")->setSubItems([
            MenuItem::linkToCrud('Ingredient', 'fa-solid fa-carrot', Ingredient::class),
            MenuItem::linkToCrud('Category', 'fas fa-tag', Category::class),
            MenuItem::linkToCrud('Measurement', 'fas  fa-scale-balanced', IngredientMeasurements::class),
        ]);

        yield MenuItem::subMenu('Gestion des menu', 'fa-solid fa-bowl-food')->setSubItems([
            MenuItem::linkToCrud('Meal', 'fa-solid fa-utensils', Meal::class),
            MenuItem::linkToCrud('MealIngredientsQuantity', 'fa-solid fa-carrot', MealIngredient::class),
            MenuItem::linkToCrud('MealIngredients', 'fas fa-scale-balanced', Ingredient::class)
        ]);
    }
}
