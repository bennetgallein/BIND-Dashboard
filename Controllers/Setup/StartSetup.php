<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 15.10.18
 * Time: 23:45
 */

namespace Controllers\Setup;


use Angle\Engine\Template\Engine;

class StartSetup {

    public static function setup(Engine $engine) {

        if (isset($_GET['n'])) {
            switch ($_GET['n']) {
                case "b":
                    $engine->render("views/setup/bind.html");
                    break;
                case "u":
                    $engine->render("views/setup/user.html");
                    break;
                default:
                    $engine->render("views/setup/database.html");
                    break;
            }
        } else {
            $engine->render("views/setup/database.html");
        }
    }
}