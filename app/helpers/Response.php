<?php
namespace App\Helpers;

use Phalcon\Di\Injectable;

class Response {

    static function make_response($status, $data){
        return ['status' => $status, 'payload' => $data];
    }
}