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

        $domain = "gal1lein2.de";

        $bind = new BIND("192.168.1.104");

        $a = $bind->getZone($domain);
        dump($a);

        $render = $a->getDomain() != "error";

        $data = array();
        if ($render) {
            $data[] = array("name" => $a->getDomain());
        }
        //dump(dns_get_record('bennetgallein.de', DNS_NS));

        $engine->render("views/domains.html", array(
            "render" => $render,
            "domains" => $data
        ));
    }
}