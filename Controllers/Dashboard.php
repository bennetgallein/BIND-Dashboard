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
use Simplon\Mysql\Mysql;
use Simplon\Mysql\PDOConnector;

class Dashboard {

    static $database;

    public static function initiate() {

        $config = json_decode(file_get_contents("config.json"));
        foreach ($config as $key => $entry) {
            define($key, $entry);
        }

        self::$database = new PDOConnector(
            DB_HOST,
            DB_USER,
            DB_PASSWORD,
            DB
        );
        self::$database = self::$database->connect('utf8', []);
        self::$database = new Mysql(self::$database);

        $engine = new Engine();
        $collection = new Collection();

        $collection->attachRoute(new Route('/', array(
            '_controller' => '\Controllers\Auth\Login::render',
            'parameters' => ["engine" => $engine],
            'methods' => 'GET'
        )));

        $collection->attachRoute(new Route('/dashboard', array(
            '_controller' => '\Controllers\Dashboard\DomainListing::render',
            'parameters' => ["engine" => $engine],
            'methods' => 'GET'
        )));

        $collection->attachRoute(new Route('/dns', array(
            '_controller' => '\Controllers\Dashboard\DomainListing::dns',
            'parameters' => ["engine" => $engine],
            'methods' => 'GET'
        )));

        /*
         * API
         */
        $collection->attachRoute(new Route('/api/login', array(
            '_controller' => '\Controllers\Auth\Login::login',
            'parameters' => [],
            'methods' => 'POST'
        )));


        $router = new Router($collection);
        $route = $router->matchCurrentRequest();
        if (!$route) {
            http_response_code(404);
            $engine->render("views/404.html");
        }

    }

    /**
     * @return Mysql
     */
    static function getDatabase() {
        return self::$database;
    }
}