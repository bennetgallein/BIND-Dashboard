<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 03.10.18
 * Time: 21:39
 */

namespace Controllers;


use Angle\Engine\RouterEngine\Collection;
use Angle\Engine\RouterEngine\Route;
use Angle\Engine\RouterEngine\Router;
use Angle\Engine\Template\Engine;

class Dashboard {

    public static function initiate() {

        $engine = new Engine();
        $collection = new Collection();

        $collection->attachRoute(new Route('/', array(
            '_controller' => '\Controllers\Dashboard::render',
            'parameters' => ["engine" => $engine],
            'methods' => 'GET'
        )));

        $router = new Router($collection);
        $route = $router->matchCurrentRequest();
        if (!$route) {
            $engine->render("views/404.html");
        }

    }
    public static function render(Engine $engine) {
        $engine->render("views/index.html", array());
    }
}