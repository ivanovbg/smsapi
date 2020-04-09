<?php
namespace App\Helpers\Exceptions;


abstract class AbstractHttpException extends \RuntimeException {
    const KEY_CODE      = 'error';
    const KEY_DETAILS   = 'validations_errors';
    const KEY_MESSAGE   = 'description';

    protected $httpCode     = null;
    protected $httpMessage  = null;

    protected $error = [];

    public function __construct($message = null, $code = null, \Exception $previous = null){
        if(!$this->httpCode || !$this->httpMessage){
            throw new \Exception("Exception without message or status code");
        }

        if($previous instanceof AbstractHttpException){
            if(is_null($code)){
                $code = $previous->getCode();
            }

            if(is_null($message)){
                $message = $previous->getMessage();
            }
        }

        $this->error = [
            self::KEY_CODE      => $code,
            self::KEY_MESSAGE   => $message,
        ];

        parent::__construct($this->httpMessage, $this->httpCode, $previous);
    }

    public function _get(){
        return $this->error;
    }

    public function _add($fields){
        if (array_key_exists(self::KEY_DETAILS, $this->error)) {
            $fields = array_merge($this->error[self::KEY_DETAILS], $fields);
        }
        $this->error[self::KEY_DETAILS] = $fields;
        return $this;
    }
}