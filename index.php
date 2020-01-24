<?php

require __DIR__ .'/vendor/autoload.php';

use App\Request;
use App\Router;

$router = Router::getInstance();

$router->get('/foo', function (Request $request) {
    var_dump($request->all());
});
