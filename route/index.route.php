<?php

$app->get('/', function ($request, $response, $args) {
    $response = $this->view->render($response, "index.view.php");

    return $response;
});
