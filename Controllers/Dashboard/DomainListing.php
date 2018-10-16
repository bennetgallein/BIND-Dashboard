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
use Controllers\Dashboard;
use Objects\User;

class DomainListing {

    public static function render(Engine $engine, User $user) {
        $data = array();
        foreach ($user->getDomains() as $domain) {
            $a = Dashboard::getBind()->getZone($domain['domain']);
            $render = $a->getDomain() != "error";
            if ($render) {
                echo substr($a->getDomain(), -1);
                $data[] = array("id" => $domain['id'],"name" => substr($a->getDomain(), -1) == "." ? rtrim($a->getDomain(), ".") : $a->getDomain() , "since" => $domain['since']);
            }
        }
        $render = true;
        $engine->render("views/domains.html", array(
            "render" => $render,
            "domains" => $data
        ));
    }

    public static function dns(Engine $engine, User $user, $domain) {
        $domain = $user->getDomain($domain);

        $a = Dashboard::getBind()->getZone($domain['domain']);

        $render = $a->getDomain() != "error";

        $data = array();
        if ($render) {
            foreach ($a->getRecords() as $record) {
                $data[] = array("name" => $record->getName(), "answer" => $record->getAnswer(), "TTL" => $record->getTTL());
            }
        }

        $engine->render("views/dns.html", array(
            "render" => $render,
            "data" => $data,
        ));
    }
}