<?php

namespace app\controllers;

use app\core\Controller;
use app\core\http\Request;
use app\models\User;

class AuthController extends Controller {

    public function renderLogin() {

        $this->setLayout('auth');

        return $this->render('auth\login');
    }

    public function renderRegister() {

        $this->setLayout('auth');

        return $this->render('auth\register');
    }

    public function register(Request $request) {

        $user = new User;

        $user->loadData($request->getBody());

        if($user->validate() && $user->register()) {
            
            return 'success';
        }

        var_dump($user->errors);
    }
}   