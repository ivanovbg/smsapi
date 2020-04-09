<?php
namespace App\Services;

use App\Helpers\Exceptions\ApplicationExceptions;
use App\Helpers\Exceptions\Http400Exception;
use App\Helpers\Exceptions\Http422Exception;
use App\Helpers\Response;
use App\Models\Message;

class MessageService{

    const MESSAGE_NOT_FOUNT = 11010;
    const MESSAGE_TEXT_MISSING = 11011;
    const MESSAGE_SINGLE_PRICE = 0.18;
    private $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    public function send($messageText){
        try {

            if (!$messageText) {
                $errors['message_text_missing'] = "Message text missing";
                $exception = new Http400Exception("Validation error", self::MESSAGE_TEXT_MISSING);
                throw $exception->_add($errors);
            }

            $messagesNumber = \App\Helpers\Message::multipart_count($messageText);
            $message = new Message();
            $message->status_id = rand(1,3);
            $message->title = $messageText;
            $message->price = (float)$messagesNumber * self::MESSAGE_SINGLE_PRICE;
            $message->save();

            if($message->save()){
                return Response::make_response(true, ['message_id' => $message->id, 'message_price' => $message->price]);
            }else{
                throw new Http422Exception("Something wrong. Please, try again later");
            }
        }catch (\PDOException $e){
            throw new ApplicationExceptions($e->getCode(), $e->getMessage(), $e);
        }
    }

    public function status($messageId){
        try {
            $message = Message::findFirst($messageId);

            if (!$message) {
                throw new Http422Exception("Message not found", self::MESSAGE_NOT_FOUNT);
            }

            return Response::make_response(true, ['message_id' => $message->id, 'message_status' => $message->status->title]);
        } catch (\PDOException $e) {
            throw new ApplicationExceptions($e->getCode(), $e->getMessage(), $e);
        }
    }
}