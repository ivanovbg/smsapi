<?php
namespace App\Helpers\Exceptions;
use App\Helpers\Exceptions\AbstractHttpException;

class Http404Exception extends AbstractHttpException {
    protected $httpCode = 404;
    protected $httpMessage = "Not found";
}