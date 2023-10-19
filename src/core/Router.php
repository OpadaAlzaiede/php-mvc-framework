<?php

class Router
{
    private static $router;

    private final function __construct(protected array $routes = [])
    {
    }

    public static function getRouter(): self {

        if(!isset(self::$router)) {

            self::$router = new self();
        }

        return self::$router;
    }

    public function get(string $uri, string $action): void {

        $this->register($uri, $action, "GET");
    }

    public function post(string $uri, string $action): void {

        $this->register($uri, $action, "POST");
    }

    public function put(string $uri, string $action): void {

        $this->register($uri, $action, "PUT");
    }

    public function delete(string $uri, string $action): void{

        $this->register($uri, $action, "DELETE");
    }

    public function route(string $method, string $uri): bool {

        if(!isset($this->routes[$method])) abort("Route not found", 404);

        $result = $this->routes[$method][$uri];

        $controller = $result['controller'];
        $function = $result['method'];

        if(class_exists($controller)) {
            try {
                $controllerInstance = new $controller();
                if(method_exists($controllerInstance, $function)) {

                    $controllerInstance->$function();
                    return true;
                } else {
                    abort("Method not found", 500);
                }

            }catch(\Exception $e) {
                abort("No method {$function} on class {$controller}", 500);
            }
        }

        return true;
    }

    public function getRoutes(): array {

        return $this->routes;
    }

    protected function register(string $uri, string $action, string $method): void {

        if(!isset($this->routes[$method])) $this->routes[$method] = [];

        list($controller, $function) = $this->extractAction($action);

        $this->routes[$method][$uri] = [
            'controller' => $controller,
            'method' => $function
        ];
    }

    protected function extractAction(string $action, string $seperator = '@'): array {

       $sepIdx = strpos($action, $seperator);

       $controller = substr($action, 0, $sepIdx);
       $function = substr($action, $sepIdx + 1, strlen($action));

       return [$controller, $function];
    }
}
