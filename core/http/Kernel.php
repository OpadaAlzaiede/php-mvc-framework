<?php

namespace app\core\http;

use app\core\Application;
use app\core\Router;

class Kernel {

    public function __construct(
        protected Router $router,
        protected Application $application
    )
    {
        //
    }

    public function handle() {

        
    }
}