<?php

require("./vendor/autoload.php");

$router = new \App\Router\Router($_GET["url"]);


$router->get("api/coucou/bonjour", function () {
    echo "coucou";
});

$router->run();