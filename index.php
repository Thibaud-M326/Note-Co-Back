<?php

header('Content-Type: application/json; charset=utf-8');

require("./vendor/autoload.php");

$router = new \App\Router\Router($_GET["url"]);


$router->post("api/auth/login", static function () {
    \App\Model\User::isUserIfTrueSoConnected($_POST["username"], $_POST["password"]);
});

$router->get("api/auth/student/getGrades", function (){
    $user = \App\Model\User::getUserBySession();
    if(is_null($user)) {
        echo json_encode([
            "status" => "error",
            "code" => 327
        ]);
    }
});

$router->run();