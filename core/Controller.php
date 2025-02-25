<?php

namespace app\core;

use app\core\Application;

class Controller {

    public string $layout = 'main';

    public function setLayout(string $layout) {

        $this->layout = $layout;
    }

    public function render(string $view, array $params = []) {

        return Application::$app->router->renderView($view, $params);
    }
}