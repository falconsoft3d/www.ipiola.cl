<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
    public function testReturn200ResponseCodeWhenTemplateExists()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'user1',
            'PHP_AUTH_PW'   => 'user123',
        ));

        $crawler = $client->request('GET', '/template/page-dashboard');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}