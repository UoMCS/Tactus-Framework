<?php
namespace Tactus;

/**
 * Singleton with configuration info
 */

class Config {

    protected static $_instance = null;

    protected $_values = array();

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new Config();
        }

        return self::$_instance;
    }

    public static function getConfig($name, $default = null) {
        return self::getInstance()->get($name, $default);
    }

    protected function __construct() {
        $json_file = file_get_contents(__DIR__ . '/../../config.json');
        $this->_values = json_decode($json_file, true);
    }

    public function get($name, $default = null) {
      if (isset($this->_values[$name]))
        return $this->_values[$name];
      else
        return $default;
    }

}
