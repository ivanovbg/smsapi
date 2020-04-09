<?php
$loader = new \Phalcon\Loader();

$loader->registerNamespaces([
    'App\Models'        => APP_PATH.'/models',
    'App\Helpers'       => APP_PATH.'/helpers',
    'App\Controllers'   => APP_PATH.'/controllers',
    'App\Services'      => APP_PATH.'/services',
    'App\Providers'     => APP_PATH.'/providers'
]);

$loader->register();