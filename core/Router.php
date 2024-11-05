<?php

namespace app\core;

use app\core\http\Request;
use app\core\http\Response;

/**
 * Class Router
 * 
 * @property array $routes
 * @property Request $request
 * @property Response $response
 * 
 * @method void get(string $path, mixed $handler)
 * @method mixed resolve()
 * @method void renderView(string $view, array $params)
 */

class Router {

    public function __construct(
        protected Request $request,
        protected Response $response,
        protected array $routes = [])
    {
        //
    }

    public function get(string $path, mixed $handler): void {

        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, mixed $handler): void {

        $this->routes['POST'][$path] = $handler;
    }

    public function resolve(): mixed {

        $path = $this->request->getPath();  
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if(! $callback) {
            $this->response->setStatusCode(404);
            return $this->renderView("errors/404");
        }

        if(is_string($callback)) {

            return $this->renderView($callback);
        }

        if(is_array($callback)) {

            $callback[0] = new $callback[0]();

            Application::$app->setController($callback[0]);
        }

        return call_user_func($callback, $this->request);
    }

    public function renderView(string $view, array $params = []): string {

        $layout = $this->layoutContent();
        $view = $this->renderOnlyView($view, $params);

        return str_replace('{{content}}', $view, $layout);
    }

    protected function renderContent(string $view): string {

        $layout = $this->layoutContent();

        return str_replace('{{content}}', $view, $layout);
    }

    protected function layoutContent(): string|false {

        $layout = Application::$app->getController()->layout;

        ob_start();
        include_once Application::$rootDirectory."/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView(string $view, array $params = []) {

        extract($params);

        ob_start();
        include_once Application::$rootDirectory."/views/$view.php";
        return ob_get_clean();
    }
}