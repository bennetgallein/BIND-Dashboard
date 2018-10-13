<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 05.10.18
 * Time: 00:08
 */

namespace Controllers\Dashboard;


use Angle\Engine\Template\Engine;
use BIND\BIND;

class DomainListing {

    public static function render(Engine $engine) {

        $domain = "gallein2.de";

        $bind = new BIND("192.168.1.104");

        $a = $bind->getZone($domain);
        $render = $a->getDomain() != "error";

        $data = array();
        if ($render) {
            $data[] = array("name" => $a->getDomain());
        }

        $engine->render("views/domains.html", array(
            "render" => $render,
            "domains" => $data
        ));
    }

    public static function dns(Engine $engine) {

        $domain = "gallein2.de";

        $bind = new BIND("192.168.1.104");

        $a = $bind->getZone($domain);

        $render = $a->getDomain() != "error";

        $data = array();
        if ($render) {
            foreach ($a->getRecords() as $record) {
                $data[] = array("name" => $record->getName(), "answer" => $record->getAnswer(), "TTL" => $record->getTTL());
            }
        }
        //$data[] = array("name" => "test", "answer" => "192.168.1.1", "TTL" => 869400);
        //$data[] = array("name" => "test", "answer" => "192.168.1.1", "TTL" => 869400);

        $engine->render("views/dns.html", array(
            "render" => $render,
            "data" => $data,
        ));
    }
}