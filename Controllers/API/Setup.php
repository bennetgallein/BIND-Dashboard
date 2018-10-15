<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 16.10.18
 * Time: 00:14
 */

namespace Controllers\API;


use Controllers\Dashboard;

class Setup {

    public static function db() {
        $host = $_POST['host'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        $db = $_POST['database'];
        try {
            $dbh = new \PDO('mysql:host=' . $host . ";dbname" . $db, $user, $password, array(\PDO::ATTR_ERRMODE >= \PDO::ERRMODE_EXCEPTION));

            Dashboard::getConfig()->set("DB_HOST", $host);
            Dashboard::getConfig()->set("DB_USER", $user);
            Dashboard::getConfig()->set("DB_PASSWORD", $password);
            Dashboard::getConfig()->set("DB", $db);

            die(json_encode(array("success" => true)));
        } catch (\PDOException $e) {
            die(json_encode(array("success" => false, "error" => $e->getMessage())));
        }
    }
}