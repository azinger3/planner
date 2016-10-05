<?php

$app->get('/budget/transaction', function ($request, $response, $args) {
    $response = $this->view->render($response, "transaction.view.php");

    return $response;
});
