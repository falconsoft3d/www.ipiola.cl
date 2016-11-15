<?php

namespace AppBundle\Tests\Views\Includes;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Controller\TestController;
use AppBundle\Service2\SidebarMenu\SidebarMenu;
use AppBundle\Service2\SidebarMenu\SidebarMenuItem;
use AppBundle\Service2\SidebarMenu\ItemCollection;

class SidebarMenuViewFunctionalTest extends WebTestCase
{
    public function testSingleItem()
    {
        // Arrange
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

        $items = array();
        $items['item'] = $item;

        $sidebarMenu = $this->createMock(SidebarMenu::class);
        $sidebarMenu->method('getItems')->willReturn($items);

        TestController::$args = array(
            'sidebarMenu' => $sidebarMenu,
        );

        // Act
        $client = static::createClient();
        $crawler = $client->request('GET', '/_render', array(
            'template' => 'includes/sidebar-menu.html.twig'
        ));

        $li = $crawler->filter('ul.page-sidebar-menu > li');

        $item     = $li->eq(0);
        $a        = $item->filter('a');
        $i        = $item->filter('i');
        $title    = $item->filter('span.title');
        $lastSpan = $item->filter('span')->last();

        // Asserts
        $this->assertContains('start', $item->attr('class'));
        $this->assertContains('active', $item->attr('class'));
        $this->assertContains('open', $item->attr('class'));
        $this->assertEquals('link', $a->attr('href'));
        $this->assertContains('icon', $i->attr('class'));
        $this->assertContains('text', $title->text());
        $this->assertNotContains('selected', $lastSpan->attr('class'));
        $this->assertNotContains('arrow', $lastSpan->attr('class'));
    }
}