<?php

//require 'function/log.function.php';

require 'vendor/autoload.php';

$app = new Slim\App();

$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer("view/");

require 'route/index.route.php';
require 'route/budget.route.php';

$app->run(); 