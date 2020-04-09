<?php
namespace App\Models;
use Phalcon\Mvc\Model;

class MessageNumber extends Model{

    public function initialize(){
        $this->setSource('messages_numbers');
    }
}