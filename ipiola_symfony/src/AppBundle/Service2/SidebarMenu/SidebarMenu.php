<?php

namespace AppBundle\Service2\SidebarMenu;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SidebarMenu
{
    protected $items;

    public function __construct(TranslatorInterface $translator, RouterInterface $router, TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $checker)
    {
        $this->items = new ItemCollection();

        $dashboardItem = new SidebarMenuItem('dashboard', array(
            'text'   => $translator->trans('menu.dashboard'),
            'link'   => $router->generate('user_dashboard'),
            'icon'   => 'icon-home',
            'active' => true,
            'start'  => true,
        ));

        $this->items[$dashboardItem->getId()] = $dashboardItem;

        if (null == $tokenStorage->getToken()) {
            return;
        }

        $buildingItems = [];

        if ($checker->isGranted('ROLE_READ_BUILDING')) {
            $buildingItems[] = new SidebarMenuItem('list_buildings', array(
                'text' => $translator->trans('menu.all_buildings'),
                'link' => $router->generate('building_index'),
            ));
        }

        if ($checker->isGranted('ROLE_CREATE_BUILDING')) {
            $buildingItems[] = new SidebarMenuItem('create_building', array(
                'text' => $translator->trans('menu.create_building'),
                'link' => $router->generate('building_add'),
            ));
        }

        if (! empty($buildingItems)) {

            $buildingItem = new SidebarMenuItem('buildings', array(
                'text'   => $translator->trans('menu.buildings'),
                'icon'   => 'icon-home',
            ));

            foreach ($buildingItems as $item) {
                $buildingItem->addChild($item);
            }

            $this->items[$buildingItem->getId()] = $buildingItem;
        }
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems(ItemCollection $items)
    {
        $this->items = $items;
    }

    public function addItem($id, SidebarMenuItem $item)
    {
        $this->items[$id] = $item;
    }

    public function getItem($id)
    {
        if (isset($this->items[$id])) {
            return $this->items[$id];
        } else {
            return null;
        }
    }

    public function setActiveItem($id)
    {
        if (isset($this->items[$id])) {

            foreach ($this->items as $item) {
                if ($item->isActive()) {
                    $item->setActive(false);
                }
            }

            $this->items[$id]->setActive(true);
            $this->items[$id]->setOpen(true);
        }
    }
}