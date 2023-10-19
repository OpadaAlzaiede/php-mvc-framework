<?php

$router->get("/", "controllers\HomeController@home");
$router->get("/about", "controllers\HomeController@about");
$router->get("/contact", "controllers\HomeController@contact");
$router->get("/dashboard", "controllers\DashboardController@index");
