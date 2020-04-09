<?php


namespace App\Helpers\Exceptions;


class Http401Exception extends AbstractHttpException{
    protected $httpCode = 401;
    protected $httpMessage = "Unauthorized ";
}