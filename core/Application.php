<?php

namespace app\core;

use app\core\http\Request;
use app\core\http\Response;

/**
 * Class Application
 * 
 * @property Router $router
 * @property string $rootDirectory
 * @property Request $request
 * @property Response $response
 * @property Application $app
 */

class Application {

    public Router $router;
    public static string $rootDirectory;
    public static Application $app;
    public Controller $controller;

    public function __construct(
        string $rootDirectory,
        public Request $request = new Request,
        public Response $response = new Response
    )
    {
        static::$rootDirectory = $rootDirectory;
        $this->router = new Router($this->request, $this->response);

        static::$app = $this;
    }

    public function setController(Controller $controller) {

        $this->controller = $controller;
    }

    public function getController() {

        return $this->controller;
    }

    public function run(): void {

        echo $this->router->resolve();
    }
}