<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class MessageStatus extends Model{

    public function initialize(){
        $this->setSource('messages_status');
        $this->belongsTo( "id", "App\Models\Message", "status_id", array( 'alias' => 'messages' ) );
        $this->hasOne('id', 'App\Models\Message', 'id', array('alias' => 'message'));
    }
}