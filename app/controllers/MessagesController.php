<?php
namespace App\Controllers;

use App\Models\Token;
use Phalcon\Mvc\Controller;

class MessagesController extends Controller{
    const DEFAULT_MESSAGE_STATUS = 1;


    public function sendAction(){
        $messageText = $this->request->get('text');
        $response = $this->messageService->send($messageText);
        return $response;
    }

    public function statusAction($messageId){
        return $this->messageService->status($messageId);
    }
}