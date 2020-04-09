<?php
namespace App\Helpers\Exceptions;

class Http422Exception extends AbstractHttpException{
    protected $httpCode = 422;
    protected $httpMessage = "Unprocessable entity";
}