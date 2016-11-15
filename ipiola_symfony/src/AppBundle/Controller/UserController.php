<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UserController extends Controller
{
    /**
    * @Route("/dashboard", name="user_dashboard")
    * @Security("has_role('ROLE_USER')")
    */
    public function dashboardAction()
    {
        $translator = $this->get('translator');
        $router = $this->get('router');

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem($translator->trans('breadcrumb.home'), $router->generate("homepage"));
        $breadcrumbs->addItem($translator->trans('page.title.dashboard'), $router->generate("user_dashboard"));

        return $this->render('page-dashboard.html.twig', array(
            'active_menu' => 'dashboard',
        ));
    }
}
