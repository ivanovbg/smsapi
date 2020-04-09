<?php
namespace App\Helpers;


class Response {
    static function make_response($status, $data){
        return ['status' => $status, 'payload' => $data];
    }
}