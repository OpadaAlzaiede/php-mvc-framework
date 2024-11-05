<?php

namespace app\controllers;

use app\core\Controller;

class AuthController extends Controller {

    public function renderLogin() {

        $this->setLayout('auth');

        return $this->render('auth\login');
    }

    public function renderRegister() {

        $this->setLayout('auth');

        return $this->render('auth\register');
    }
}