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
use Objects\Config;
use Objects\User;
use Simplon\Mysql\Mysql;
use Simplon\Mysql\PDOConnector;

class Dashboard {

    static $database;
    static $user;
    static $config;

    public static function initiate() {

        self::$config = $config = new Config();

        foreach ($config->getAll() as $key => $entry) {
            define($key, $entry);
        }

        $setup = defined("DB_HOST") ? false : true;

        $engine = new Engine();
        $collection = new Collection();

        if (!$setup) {
            self::$user = $user = isset($_SESSION['d_user']) ? $_SESSION['d_user'] : false;
            if ($user) if (!($user instanceof User)) die("No cheating in the Session!");

            self::$database = new PDOConnector(
                DB_HOST,
                DB_USER,
                DB_PASSWORD,
                DB
            );
            self::$database = self::$database->connect('utf8', []);
            self::$database = new Mysql(self::$database);

            self::registerRoutes($collection, $engine, $user);
        } else {

            $collection->attachRoute(new Route("/api/test/db", array(
                '_controller' => '\Controllers\API\Setup::db',
                'methods' => 'POST'
            )));

            $collection->attachRoute(new Route("/api/test/bind", array(
                '_controller' => '\Controllers\API\Setup::bind',
                'methods' => 'POST'
            )));


            $collection->attachRoute(new Route("/setup", array(
                '_controller' => '\Controllers\Setup\StartSetup::setup',
                'parameters' => ["engine" => $engine],
                'methods' => 'GET'
            )));
        }

        $router = new Router($collection);
        $route = $router->matchCurrentRequest();
        if (!$route) {
            http_response_code(404);
            $engine->render("views/404.html");
        }

    }

    public static function registerRoutes($collection, $engine, $user) {

        if ($user) {
            $collection->attachRoute(new Route('/', array(
                '_controller' => '\Controllers\Dashboard\DomainListing::render',
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
        } else {
            $collection->attachRoute(new Route('/', array(
                '_controller' => '\Controllers\Auth\Login::render',
                'parameters' => ["engine" => $engine],
                'methods' => 'GET'
            )));
        }
        /*
         * API
         */
        $collection->attachRoute(new Route('/api/login', array(
            '_controller' => '\Controllers\Auth\Login::login',
            'methods' => 'POST'
        )));

        $collection->attachRoute(new Route("/api/logout", array(
            '_controller' => '\Controllers\Auth\Login::logout',
            'methods' => 'GET'
        )));
    }


    /**
     * @return Mysql
     */
    static function getDatabase() {
        return self::$database;
    }

    /**
     * @return User
     */
    public static function getUser() {
        return self::$user;
    }

    /**
     * @return Config
     */
    public static function getConfig() {
        return self::$config;
    }

}