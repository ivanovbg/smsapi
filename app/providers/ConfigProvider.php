<?php
namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class ConfigProvider implements ServiceProviderInterface{

    public function register(DiInterface $di):void{
        $config = require APP_PATH.'/config/config.php';
        $di->set("config", $config);
    }
}