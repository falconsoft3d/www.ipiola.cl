<?php

namespace AppBundle\Tests\Service2\SidebarMenu;

use AppBundle\Tests\BaseWebTestCase;
use AppBundle\Service2\SidebarMenu\SidebarMenuItem;
use Andaniel05\HierarchyTrait\HierarchyInterface;

class SidebarMenuItemTest extends BaseWebTestCase
{
    public function testDefauls()
    {
        $item = new SidebarMenuItem('id', []);

        $this->assertEmpty($item->getText());
        $this->assertEmpty($item->getLink());
        $this->assertEmpty($item->getIcon());
        $this->assertFalse($item->isActive());
        $this->assertFalse($item->isStart());
        $this->assertFalse($item->isOpen());
        $this->assertFalse($item->isSelected());
    }

    public function testArgsByConstructor()
    {
        $args = array(
            'text'     => 'text',
            'link'     => 'link',
            'icon'     => 'icon',
            'active'   => true,
            'start'    => true,
            'open'     => true,
            'selected' => true,
        );

        $item = new SidebarMenuItem('id', $args);

        $this->assertEquals('text', $item->getText());
        $this->assertEquals('link', $item->getLink());
        $this->assertEquals('icon', $item->getIcon());
        $this->assertTrue($item->isActive());
        $this->assertTrue($item->isStart());
        $this->assertTrue($item->isOpen());
        $this->assertTrue($item->isSelected());
    }

    public function testInstanceOfHierarchyInterface()
    {
        $item = new SidebarMenuItem('id', []);

        $this->assertInstanceOf(HierarchyInterface::class, $item);
        $this->assertEquals('id', $item->getId());
    }

    public function testSetSelectedInvokeSetActiveMethod()
    {
        $item = $this->getMockBuilder(SidebarMenuItem::class)
                     ->setConstructorArgs(['id', array('active' => false)])
                     ->setMethods(['setActive'])
                     ->getMock();

        $item->expects($this->once())
             ->method('setActive')
             ->with($this->equalTo(true));

        $item->setSelected(true);
    }

    public function testSetActiveInvokeSetActiveOnTheParent()
    {
        $parent = new SidebarMenuItem('parent', array('active' => false));

        $child = new SidebarMenuItem('child', array());
        $child->setParent($parent);

        $child->setActive(true);

        $this->assertTrue($parent->isActive());
    }

    public function testSetSelectedInvokeSetActiveAndSetOpenOnTheParent()
    {
        $parent = new SidebarMenuItem('parent', array('active' => false, 'open' => false));

        $child = new SidebarMenuItem('child', array());
        $child->setParent($parent);

        $child->setSelected(true);

        $this->assertTrue($parent->isActive());
        $this->assertTrue($parent->isOpen());
    }
}