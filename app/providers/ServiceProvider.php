<?php
namespace App\Providers;

use App\Services\MessageService;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface{

    public function register(DiInterface $di):void{
        $di->setShared('messageService', function(){
            return new MessageService($this->get('config'));
        });
    }
}