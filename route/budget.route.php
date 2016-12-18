<?php

$app->get('/budget', function ($request, $response, $args) {
    $response = $this->view->render($response, "budget.view.php");

    return $response;
});

$app->get('/budget/transaction', function ($request, $response, $args) {
    $response = $this->view->render($response, "transaction.view.php");

    return $response;
});

$app->get('/budget/summary', function ($request, $response, $args) {
    $response = $this->view->render($response, "summary.view.php");

    return $response;
});

$app->get('/budget/average', function ($request, $response, $args) {
    $response = $this->view->render($response, "average.view.php");

    return $response;
});

$app->get('/budget/breakdown', function ($request, $response, $args) {
    $response = $this->view->render($response, "breakdown.view.php");

    return $response;
});
