<?php
namespace App\Models;

use Phalcon\Mvc\Model;

class Token extends Model{

    public function initialize(){
        $this->setSource('tokens');
    }

    public static function checkToken($token, $is_active = 1){
        return Token::findFirst([
                'conditions' => 'token=:token: AND is_active=:is_active: AND (valid_to IS NULL OR valid_to >= NOW())',
                'bind' => ['token' => $token, 'is_active' => $is_active]
            ]
        );
    }
}