<?php

namespace App\Controller;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS, Attribute::TARGET_METHOD)]
class Route {

    public $route;
    public function __construct($route)
    {
        $this->$route = $route;
    }
}