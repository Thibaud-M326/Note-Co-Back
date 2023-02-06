<?php

namespace App\Model;

use App\Model\User as ModelUser;

class User {


    protected $username;
    protected static $paths = array();
    protected static $userPaths = array();
    protected $rank;

    protected $id;

    public function __construct($username, $id)
    {
        $this->username = $username;
        $this->id = $id;
    }


    public static function getJson($type) {
        if ($type === "P") {

            $data = file_get_contents("./assets/json/teacher.json");
            return json_decode($data);
        }

        if ($type === "E") {

            $data = file_get_contents("./assets/json/student.json");
            return json_decode($data);
        }

        return null;
    }

    
    public static function isUserIfTrueSoConnected($username, $password) {
        $type = substr($username, 0, 1);
        $json = User::getJson($type);
        if ($type ==="P") {
            $users = $json->teachers;
        }else if ($type === "E"){
            $users = $json->students;
        } else {
            echo json_encode([
                "status" => "error"
            ]);
            return false;
        }
        foreach ($users as $user) {
            if ($user->username === $username && $user->password === $password) {
                echo json_encode([
                    "status" => "connected"
                ]);
                $user = new User($user->username, $user->id);
                $user->saveAuth();
                return $user;
            }
        }
        echo json_encode([
            "status" => "unknown"
        ]);
        return false;
        
    }

    public function saveAuth() {
        session_start();
        $_SESSION["auth"]["connected"] = true;
        $_SESSION["auth"]["type"] = substr($this->username, 0, 1);
        $_SESSION["auth"]["id"] = $this->id;
        $_SESSION["auth"]["username"] = $this->username;
    }

    public static function getUserBySession() {
        if (isset($_SESSION["auth"])) {
            return new User($_SESSION["auth"]["username"], $_SESSION["auth"]["id"]);
        }
        return null;
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }
}

