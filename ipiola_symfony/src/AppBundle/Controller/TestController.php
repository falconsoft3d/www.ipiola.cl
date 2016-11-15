<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    public static $args = [];

    public function renderAction(Request $request)
    {
        $template = $request->query->get('template');
        $args = static::$args;

        static::$args = [];

        return $this->render($template, $args);
    }
}