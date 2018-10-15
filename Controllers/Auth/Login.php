<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 12.10.18
 * Time: 23:14
 */

namespace Controllers\Auth;


use Angle\Engine\Template\Engine;
use Controllers\Dashboard;
use Objects\User;

class Login {

    public static function render(Engine $engine) {
        $engine->render("views/index.html", array());
    }

    public static function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = Dashboard::getDatabase()->fetchRow("SELECT * FROM users WHERE email = :email", ['email' => $email]);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                $user = new User($result['id'], $result['uname'], $result['email']);
                $_SESSION['d_user'] = $user;
                echo json_encode(["success" => "true"]);
            } else {
                echo json_encode(["success" => "false", "error" => "Credentials are wrong!"]);
            }
        } else {
            echo json_encode(["success" => "false", "error" => "User not found!"]);
        }
    }

    public static function logout() {
        if (Dashboard::getUser()) {
            session_unset();
            session_destroy();
            echo json_encode(["success" => true]);
        }
    }
}