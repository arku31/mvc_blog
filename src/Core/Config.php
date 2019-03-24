<?php
namespace App\Core;

class Config
{
    const CONFIG_DIR = ROOT_PATH. 'config';
    protected $config;
    private static $instance;

    /**
     * Singletone
     */
    protected function __construct()
    {
        $files = glob(self::CONFIG_DIR.'/*.php');

        foreach ($files as $file) {
            $key = explode('.', basename($file))[0];
            $this->config[$key] = require $file;
        }
    }

    /**
     * @return Config
     */
    public static function init()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $namespace
     * @param $value
     * @return mixed|null
     */
    public function get($namespace, $value = null)
    {
        if (empty($value) && array_key_exists($namespace, $this->config)) {
            return $this->config[$namespace];
        }
        if (array_key_exists($namespace, $this->config) && array_key_exists($value, $this->config[$namespace])) {
            return $this->config[$namespace][$value];
        }

        return null;
    }
}