<?php

require 'vendor/autoload.php';

$app = new Slim\App();

$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer("view/");


// Routes
$app->get('/', function ($request, $response, $args) {
    $response = $this->view->render($response, "index.view.php");

    return $response;
});

$app->get('/budget/transaction', function ($request, $response, $args) {
    $response = $this->view->render($response, "transaction.view.php");

    return $response;
});


// App Run
$app->run();
