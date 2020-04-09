<?php
namespace App\Helpers\Exceptions;
use App\Helpers\Exceptions\AbstractHttpException;

class Http400Exception extends AbstractHttpException{
    protected $httpCode = 400;
    protected $httpMessage = "Bad request";
}