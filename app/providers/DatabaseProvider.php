<?php
namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Model\MetaData\Memory as MetaDataAdapter;

class DatabaseProvider implements ServiceProviderInterface{


    public function register(DiInterface $di):void{
        $di->setShared('db', function (){
            $config = $this->get('config');

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

        $di->setShared('modelsMetadata', function () {
            return new MetaDataAdapter();
        });
    }


}