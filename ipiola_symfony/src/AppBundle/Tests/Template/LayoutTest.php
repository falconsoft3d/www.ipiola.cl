<?php

namespace AppBundle\Tests\Template;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LayoutTest extends WebTestCase
{
    public function testUserRoleHaveNewBuildingPageAction()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'user1',
            'PHP_AUTH_PW'   => 'user123',
        ));

        $container  = $client->getContainer();
        $translator = $container->get('translator');
        $crawler    = $client->request('GET', '/template/layout');

        $link = $crawler->selectLink($translator->trans('action.new_building'));

        $this->assertEquals(1, $link->count());
    }
}