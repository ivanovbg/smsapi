<?php
namespace App\Helpers\Exceptions;

class Http500Exception extends AbstractHttpException{
    protected $httpCode = 500;
    protected $httpMessage = "Internal Server Error";
}