<?php
namespace App\Controllers;

use App\Models\Token;
use Phalcon\Mvc\Controller;

class MessagesController extends Controller{
    const DEFAULT_MESSAGE_STATUS = 1;


    public function sendAction(){
        $messageData = $this->request->get();
        $response = $this->messageService->send($messageData);
        return $response;
    }

    public function statusAction($messageId){
        return $this->messageService->status($messageId);
    }
}