<?php

namespace app\core\http;

/**
 * Class Request
 * 
 * @method void string getPath()
 * @method void string getMethod()
 * @method array getBody()
 */

class Request {

    public function getPath(): string {

        $path = $_SERVER['REQUEST_URI'] ?? '/';
        
        if(! $position = strpos($path, '?')) return $path;

        return substr($path, 0, $position);
    }

    public function getMethod(): string {

        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool {

        return $this->getMethod() === 'GET';
    }

    public function isPost(): bool {

        return $this->getMethod() === 'POST';
    }

    public function getBody() {

        $body = [];

        if($this->getMethod() === 'GET') {

            foreach($_GET as $key => $value) {

                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if($this->getMethod() === 'POST') {

            foreach($_POST as $key => $value) {

                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}