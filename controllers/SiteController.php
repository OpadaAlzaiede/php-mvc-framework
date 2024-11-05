<?php

namespace app\controllers;

use app\core\Controller;
use app\core\http\Request;

class SiteController extends Controller {

    public function home() {

        return $this->render('home', ['name' => 'Obada']);
    }

    public function create() {

        return $this->render('contact');
    }

    public function store(Request $request) {

        $data = $request->getBody();

        print_r($data);

        return 'handling submitted data';
    }
    
}