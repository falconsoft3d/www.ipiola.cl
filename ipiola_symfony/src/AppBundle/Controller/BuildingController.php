<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Building;
use AppBundle\Form\Type\BuildingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Building controller.
 *
 * @Route("building")
 */
class BuildingController extends Controller
{
    protected $breadcrumbs;
    protected $translator;
    protected $router;
    protected $sidebarMenu;
    protected $menu;
    protected $currentUser;

    public function init()
    {
        $this->translator  = $this->get('translator');
        $this->router      = $this->get('router');
        $this->breadcrumbs = $this->get("white_october_breadcrumbs");

        $this->currentUser = $this->get('security.token_storage')
                                  ->getToken()
                                  ->getUser();

        $this->breadcrumbs->addItem($this->translator->trans('breadcrumb.home'), $this->router->generate("homepage"));
        $this->breadcrumbs->addItem($this->translator->trans('page.title.buildings.list'), $this->router->generate("building_index"));

        $this->sidebarMenu = $this->get('sidebarMenu');
        $this->menu = $this->sidebarMenu->getItem('buildings');

        $this->sidebarMenu->setActiveItem('buildings');
    }

    protected function activeChild($id)
    {
        $this->menu->getChild($id)->setSelected(true);
    }

    /**
     * Lists all building entities.
     *
     * @Route("/", name="building_index")
     * @Method("GET")
     * @Security("has_role('ROLE_READ_BUILDING')")
     */
    public function indexAction()
    {
        $this->init();

        $this->activeChild('list_buildings');

        $em = $this->getDoctrine()->getManager();

        $buildings = $em->getRepository('AppBundle:Building')
                        ->findByOwner($this->currentUser);

        return $this->render('building/index.html.twig', array(
            'buildings' => $buildings
        ));
    }

    /**
     * Finds and displays a building entity.
     *
     * @Route("/show/{id}", name="building_show")
     * @Method("GET")
     * @Security("has_role('ROLE_READ_BUILDING')")
     */
    public function showAction(Building $building)
    {
        $this->init();

        if ($this->currentUser->getId() != $building->getOwner()->getId()) {
            $this->addFlash('danger', $this->translator->trans('alert.danger.access_denied'));
            return $this->redirectToRoute('building_index');
        }

        $this->breadcrumbs->addItem($this->translator->trans('page.title.buildings.show', array('%name%' => $building->getName())));

        return $this->render('building/show.html.twig', array(
            'building' => $building
        ));
    }

    /**
     * @Route("/add", name="building_add")
     * @Security("has_role('ROLE_CREATE_BUILDING')")
     */
    public function addAction(Request $request)
    {
        $this->init();
        $this->breadcrumbs->addItem($this->translator->trans('page.title.buildings.create'), $this->router->generate("building_add"));
        $this->activeChild('create_building');

        $form = $this->createForm(new BuildingType($this->get('translator')));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $building = $form->getData();
            $building->setOwner($this->currentUser);

            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('alert.success.building_created'));

            return $this->redirectToRoute('building_index');
        }

        return $this->render('building/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{id}", name="building_edit")
     * @Security("has_role('ROLE_UPDATE_BUILDING')")
     */
    public function editAction(Building $building, Request $request)
    {
        $this->init();

        if ($this->currentUser->getId() != $building->getOwner()->getId()) {
            $this->addFlash('danger', $this->translator->trans('alert.danger.access_denied'));
            return $this->redirectToRoute('building_index');
        }

        $form = $this->createForm(new BuildingType($this->get('translator')), $building);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $building = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('alert.success.building_updated'));

            return $this->redirectToRoute('building_index');
        }

        $this->breadcrumbs->addItem($this->translator->trans('page.title.buildings.edit', array('%name%' => $building->getName())));

        return $this->render('building/edit.html.twig', array(
            'building' => $building,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/remove/{id}", name="building_remove")
     * @Security("has_role('ROLE_DELETE_BUILDING')")
     */
    public function removeAction(Building $building)
    {
        $this->init();

        if ($this->currentUser->getId() != $building->getOwner()->getId()) {
            $this->addFlash('danger', $this->translator->trans('alert.danger.access_denied'));
            return $this->redirectToRoute('building_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($building);
        $em->flush();

        $this->addFlash('success', $this->get('translator')->trans('alert.success.building_deleted'));

        return $this->redirectToRoute('building_index');
    }
}
