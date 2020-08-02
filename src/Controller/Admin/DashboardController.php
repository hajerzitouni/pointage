<?php

namespace App\Controller\Admin;

use App\Entity\Departement;
use App\Entity\Historique;
use App\Entity\Employe;
use App\Entity\Societe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;

// ...

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

       return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
      //return $this->redirect($routeBuilder->setController(DepartementCrudController::class)->generateUrl());
        // you can also redirect to different pages depending on the current user
        if ('jane' === $this->getUser()->getUsername()) {
            return $this->redirect('...');
        }

        // you can also render some template to display a proper Dashboard
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        return $this->render('some/path/my-dashboard.html.twig');
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion Pointage');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('User', 'fa fa-user');
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
        yield MenuItem::linkToCrud('Societe', 'fa fa-home', Societe::class);
        yield MenuItem::linkToCrud('Departement', 'fa fa-building', Departement::class);

        //yield MenuItem::linkToRoute('Employe', 'fa fa-id-badge ','employe_index');
        yield MenuItem::linkToCrud('Employe', 'fa fa-id-badge', Employe::class);
        yield MenuItem::linkToCrud('Historique', 'fa fa-tasks', Historique::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            ->setName($user->getUsername())
            // use this method if you don't want to display the name of the user
           // ->displayUserName(false)

           /* // you can return an URL with the avatar image
            ->setAvatarUrl('https://...')
            ->setAvatarUrl($user->getProfileImageUrl())
            // use this method if you don't want to display the user image
            ->displayUserAvatar(false)*/
            // you can also pass an email address to use gravatar's service
            //->setGravatarEmail($user->getEmail())

            // you can use any type of menu item, except submenus
            ->addMenuItems([
                MenuItem::linkToRoute('My Profile', 'fa fa-id-card', "fos_user_profile_show"),
                MenuItem::linkToRoute('Settings', 'fa fa-user-cog', "fos_user_profile_edit"),
               // MenuItem::section(),
               // MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            ]);
    }
}

