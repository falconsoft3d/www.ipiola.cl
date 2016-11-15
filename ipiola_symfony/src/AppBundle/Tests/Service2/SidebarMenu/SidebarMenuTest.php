<?php

namespace AppBundle\Tests\Service2\SidebarMenu;

use AppBundle\Service2\SidebarMenu\SidebarMenu;
use AppBundle\Service2\SidebarMenu\SidebarMenuItem;
use AppBundle\Tests\BaseWebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SidebarMenuTest extends BaseWebTestCase
{
    public function testExistsDashboardItem()
    {
        $menu  = new SidebarMenu($this->translator, $this->router, $this->tokenStorage, $this->checker);
        $items = $menu->getItems();
        $item  = $items['dashboard'];

        $this->assertEquals($this->translator->trans('menu.dashboard'), $item->getText());
        $this->assertEquals($this->router->generate('user_dashboard'), $item->getLink());
        $this->assertEquals('icon-home', $item->getIcon());
        $this->assertTrue($item->isStart());
        $this->assertTrue($item->isActive());
    }

    public function testExistsAllBuildingsLinkIfUserHaveRoleReadBuilding()
    {
        // Arrange
        $tokenStorage = $this->createMock(TokenStorageInterface::class);
        $tokenStorage->method('getToken')->willReturn($this->createMock(TokenInterface::class));

        $checker = $this->createMock(AuthorizationCheckerInterface::class);
        $checker->method('isGranted')->willReturn(true);

        // Act
        $menu = new SidebarMenu($this->translator, $this->router, $tokenStorage, $checker);
        $buildingItem = $menu->getItems()['buildings'];
        $listItem = $buildingItem->getChild('list_buildings');

        // Asserts
        $this->assertEquals($this->translator->trans('menu.all_buildings'), $listItem->getText());
        $this->assertEquals($this->router->generate('building_index'), $listItem->getLink());
    }

    public function testExistsCreateBuildingLinkIfUserHaveRoleCreateBuilding()
    {
        // Arrange
        $tokenStorage = $this->createMock(TokenStorageInterface::class);
        $tokenStorage->method('getToken')->willReturn($this->createMock(TokenInterface::class));

        $checker = $this->createMock(AuthorizationCheckerInterface::class);
        $checker->method('isGranted')->willReturn(true);

        // Act
        $menu = new SidebarMenu($this->translator, $this->router, $tokenStorage, $checker);
        $buildingItem = $menu->getItems()['buildings'];
        $createItem = $buildingItem->getChild('create_building');

        // Asserts
        $this->assertEquals($this->translator->trans('menu.create_building'), $createItem->getText());
        $this->assertEquals($this->router->generate('building_add'), $createItem->getLink());
    }

    public function testBuildingsMenuNotExists()
    {
        // Arrange
        $tokenStorage = $this->createMock(TokenStorageInterface::class);
        $tokenStorage->method('getToken')->willReturn($this->createMock(TokenInterface::class));

        $checker = $this->createMock(AuthorizationCheckerInterface::class);
        $checker->method('isGranted')->willReturn(false);

        // Act
        $menu = new SidebarMenu($this->translator, $this->router, $tokenStorage, $checker);

        // Asserts
        $this->assertArrayNotHasKey('buildings', $menu->getItems());
    }

    public function testAddItemAndGetItem()
    {
        $item = $this->createMock(SidebarMenuItem::class);
        $menu = new SidebarMenu($this->translator, $this->router, $this->tokenStorage, $this->checker);

        $menu->addItem('item', $item);

        $this->assertSame($item, $menu->getItem('item'));
    }

    public function testSetActiveMethodInvokeSetActiveOnItem()
    {
        // Arrange
        $item = $this->getMockBuilder(SidebarMenuItem::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['setActive'])
                     ->getMock();

        $item->expects($this->once())
             ->method('setActive')
             ->with($this->equalTo(true));

        $menu = new SidebarMenu($this->translator, $this->router, $this->tokenStorage, $this->checker);
        $menu->addItem('item', $item);

        // Act
        $menu->setActiveItem('item');
    }

    public function testSetActiveMethodRemoveOldActiveItem()
    {
        $item1 = $this->getMockBuilder(SidebarMenuItem::class)
                      ->setConstructorArgs(['item1', array('active' => true)])
                      ->getMock();

        $item1->expects($this->any())
              ->method('setActive')
              ->with($this->equalTo(false));

        $item2 = new SidebarMenuItem('item2', array());

        $menu = new SidebarMenu($this->translator, $this->router, $this->tokenStorage, $this->checker);
        $menu->addItem('item1', $item1);
        $menu->addItem('item2', $item2);

        $menu->setActiveItem('item2');
    }
}