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
        $engine->render("views/setup/database.html");
    }
}