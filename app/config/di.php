<?php
$container = new \Phalcon\Di\FactoryDefault();

$container->set("config", $config);

$container->setShared('db', function (){
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    return new $class($params);
});

$container->setShared('articlesService', function(){
    return new \App\Services\MessageService($this->getConfig());
});

return $container;