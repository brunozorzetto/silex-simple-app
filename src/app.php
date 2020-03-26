<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application();

/** Containers **/

$app['value1'] = 'Test';

$app['getDateTime'] = function() {
    $now = new \DateTime();
    return $now->format('Y-m-d H:i:s');
};

$app['view.config'] = [
    'path_templates' =>  __DIR__ . '/../templates',
];

$app['view.renderer'] = function() use ($app) {
    $pathTemplates = $app['view.config']['path_templates'];
    return new \App\View\ViewRenderer($pathTemplates);
};

/** ROUTES **/

$app->get('/', function() use ($app) {
    return $app['view.renderer']->render('home');
});

$app->get('/test', function(Application $app) {
    return new Response($app['getDateTime']);
});

$app->post('/get-name', function(Request $request) use ($app) {

    $name = $request->get('name', 'no name');

    return $app['view.renderer']->render('get-name', [
        'name' => $name,
    ]);
});

$app->get('/home', function(Request $request) use ($app) {

    $getParams = $request->query->all();
    $postParams = $request->request->all();

    return $app['view.renderer']->render('home');
});

/** Route with param */
$app->post('/home/{param}', function(Request $request, $param) use ($app) {

    return $app['view.renderer']->render('home', [
        'param' => $param
    ]);
});

/** Run application */

$app->run();