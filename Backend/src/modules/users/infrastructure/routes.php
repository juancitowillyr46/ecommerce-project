<?php
declare(strict_types=1);
use Slim\Routing\RouteCollectorProxy;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

return function (RouteCollectorProxy $group) {

    $group->group('/users', function (RouteCollectorProxy $group): Response {
        $group->post('', function (ServerRequest $request, Response $response) {
            $name = 'Juan Rodas';
            return $response->withStatus(201)->withJson(array("user" => $name));
        });
        $group->get('/{id}', function (ServerRequest $request, Response $response, array $args): Response {
            $name = $args['id'];
            return $response->withStatus(200)->withJson(array("user" => $name));
        });
        $group->put('/{id}', function (ServerRequest $request, Response $response, array $args): Response {
            $name = $args['id'];
            return $response->withStatus(200)->withJson(array("user" => $name));
        });
        $group->delete('/{id}', function (ServerRequest $request, Response $response, array $args): Response {
            $name = $args['id'];
            return $response->withStatus(200)->withJson(array("user" => $name));
        });
    });

};