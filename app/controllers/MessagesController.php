<?php
namespace App\Controllers;

use App\Models\Token;
use Phalcon\Mvc\Controller;

class MessagesController extends Controller{

    public function sendAction(){
    }

    public function statusAction($messageId){
        return $this->messageService->status($messageId);
    }
}