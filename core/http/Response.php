<?php

namespace app\core\http;

/**
 * Class Response
 * 
 * @method void setStatusCode(int $code)
 * 
 */

class Response {

    public function setStatusCode(int $code): void{

        http_response_code($code);
    }
}