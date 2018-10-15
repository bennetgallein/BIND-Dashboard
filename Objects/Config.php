<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 16.10.18
 * Time: 00:23
 */

namespace Objects;


class Config {

    private $settings = array();

    public function __construct() {

        if (!(file_exists("config.json"))) {
            $fh = fopen("config.json", 'w');
            fwrite($fh, "");
            fclose($fh);
        }

        $config = file_get_contents("config.json");
        $config = json_decode($config, true);
        $this->settings = array_merge($this->settings, $config);

    }

    public function get($entry) {
        return $this->settings[$entry];
    }

    public function set($entry, $value) {
        $this->settings[$entry] = $value;
    }

    public function getAll() {
        return $this->settings;
    }

    public function __destruct() {
        /** TODO: File dont get saved when called over API. Look into that! */
        //dump(json_encode($this->settings, JSON_PRETTY_PRINT));
        echo file_put_contents("config.json", json_encode($this->settings, JSON_PRETTY_PRINT));
    }
}