<?php

require("./vendor/autoload.php");

$router = new \App\Router\Router($_GET["url"]);

$router->post("/api/auth/login/", function() {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $isUser = \App\Model\User::isUserIfTrueSoConnected($username, $password);
});

$router->run();