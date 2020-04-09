<?php
namespace App\Providers;

use App\Models\Token;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class AuthenticationProvider implements ServiceProviderInterface{

    public function register(DiInterface $di):void{
        $di->setShared("authentication", function (){
            $token = $this->get('request')->getHeader('Token');
            $checkToken = Token::checkToken($token);
            return !empty($token) && $checkToken;
        });
    }
}