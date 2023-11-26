<?php
    use Project\Router;

    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/app/core/Router.php';

    $router = new Router();
    $router->action();