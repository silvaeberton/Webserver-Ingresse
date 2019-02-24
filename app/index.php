<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'db.php';

$app = new \Slim\App;

$app->get('/api/get', function(Request $request, Response $response){
    echo "GET <br />";
    $sql = "SELECT * FROM users";
    echo $sql;
    
});

$app->post('/api/beto', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $response->getBody()->write("Hello POST, $id");

    return $response;
});

$app->put('/api/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $response->getBody()->write("Hello PUT, $id");

    return $response;
});

$app->delete('/api/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $response->getBody()->write("Hello DELETE, $id");

    return $response;
});

$app->run();