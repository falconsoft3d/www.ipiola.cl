<?php

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseWebTestCase extends WebTestCase
{
    protected $client;
    protected $container;
    protected $translator;
    protected $router;
    protected $tokenStorage;
    protected $checker;

    public function setUp()
    {
        $this->client       = static::createClient();
        $this->container    = $this->client->getContainer();
        $this->translator   = $this->container->get('translator');
        $this->router       = $this->container->get('router');
        $this->tokenStorage = $this->container->get('security.token_storage');
        $this->checker      = $this->container->get('security.authorization_checker');
    }
}