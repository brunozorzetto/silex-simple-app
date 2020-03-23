<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app->get('/', function() {
    ob_start();
    include __DIR__ . '/../templates/home.phtml';
    $response = ob_get_clean();

    return new Response($response);
});

$app->post('/home', function(Request $request) {
    
    $paramName = $request->get('name');

    $getParams = $request->query->all();
    $postParams = $request->request->all();
    
    return new Response($paramName);
});

/** Route with param */
$app->post('/home/{param}', function(Request $request, $param) {
    
    $paramName = $request->get('name');

    $getParams = $request->query->all();
    $postParams = $request->request->all();
    
    return new Response($param);
});

$app->run();