<?php
namespace App\Models;

use Phalcon\Mvc\Model;

class Message extends Model{
    public function initialize(){
        $this->setSource('messages');
        $this->hasOne('status_id', 'App\Models\MessageStatus', 'id', array('alias' => 'status'));
    }
}