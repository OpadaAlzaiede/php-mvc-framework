<?php

function basePath($path) {

    return BASE_PATH . $path;
}


function abort($message, $code = 404) {

    http_response_code($code);
    echo $message;
    exit();
}
