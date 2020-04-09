<?php

return new \Phalcon\Config([
    'version' => 1,
    'database' => [
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'smsapi',
        'charset'  => 'utf8',
    ],
    'application' => [
        'baseDir' => BASE_PATH,
        'appDir'  => APP_PATH,
        'helpersDir' => APP_PATH.'/helpers',
        'modelsDir' => APP_PATH.'/models',
        'webpath' => 'http://localhost'
    ]
]);