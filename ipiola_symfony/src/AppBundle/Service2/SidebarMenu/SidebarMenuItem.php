<?php

namespace AppBundle\Service2\SidebarMenu;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Andaniel05\HierarchyTrait\HierarchyInterface;
use Andaniel05\HierarchyTrait\HierarchyTrait;

class SidebarMenuItem implements HierarchyInterface
{
    use HierarchyTrait;

    protected $id;
    protected $text;
    protected $link;
    protected $icon;
    protected $active;
    protected $start;
    protected $open;
    protected $selected;

    public function __construct($id, array $args)
    {
        $this->id = $id;

        $defaults = array(
            'text'     => '',
            'link'     => '',
            'icon'     => '',
            'active'   => false,
            'start'    => false,
            'open'     => false,
            'selected' => false,
        );

        $args = array_merge($defaults, $args);

        $this->text     = $args['text'];
        $this->link     = $args['link'];
        $this->icon     = $args['icon'];
        $this->active   = $args['active'];
        $this->start    = $args['start'];
        $this->open     = $args['open'];
        $this->selected = $args['selected'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function isStart()
    {
        return $this->start;
    }

    public function isOpen()
    {
        return $this->open;
    }

    public function isSelected()
    {
        return $this->selected;
    }

    public function setActive($active)
    {
        $this->active = $active;

        if (true === $active && null != $this->parent) {
            $this->parent->setActive(true);
        }
    }

    public function setOpen($open)
    {
        $this->open = $open;
    }

    public function setSelected($selected)
    {
        $this->selected = $selected;

        if (true === $selected) {
            $this->setActive(true);

            if (null != $this->parent) {
                $this->parent->setActive(true);
                $this->parent->setOpen(true);
            }
        }
    }
}