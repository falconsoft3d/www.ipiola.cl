<?php

namespace AppBundle\Service2\SidebarMenu;

use Andaniel05\ObjectCollection\ObjectCollection;

class ItemCollection extends ObjectCollection
{
    public function __construct()
    {
        parent::__construct(SidebarMenuItem::class);
    }
}