<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SecurityController extends AbstractController
{




    /**
     * @Route("/e", name="employe_home", methods={"GET"})
     */
    public function home()
    {
        return $this->render('Security\Employe_home.html.twig');
    }

    /**
     * @Route("/home")
     */
    public function redirectAction()
    {
        $authCheker = $this->container->get('security.authorization_checker');
        if($authCheker->isGranted('ROLE_SUPER_ADMIN'))
        {
            return $this->redirectToRoute('app_admin_dashboard_index');
        }
        else if ($authCheker->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('employe_index');
        }
        else
        {
            return $this->redirectToRoute('historique_new');

        }

    }

}