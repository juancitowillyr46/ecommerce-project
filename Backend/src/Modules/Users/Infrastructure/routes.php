<?php
declare(strict_types=1);
use Slim\Routing\RouteCollectorProxy;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

return function (RouteCollectorProxy $group) {

    $group->group('/users', function (RouteCollectorProxy $group) {

        $group->post('', \App\Modules\Users\Infrastructure\Controllers\UsersController::class);

//        $group->get('/{id}', function (ServerRequest $request, Response $response, array $args): Response {
//            $name = $args['id'];
//            return $response->withStatus(200)->withJson(array("user" => $name));
//        });
//        $group->put('/{id}', function (ServerRequest $request, Response $response, array $args): Response {
//            $name = $args['id'];
//            return $response->withStatus(200)->withJson(array("user" => $name));
//        });
//        $group->delete('/{id}', function (ServerRequest $request, Response $response, array $args): Response {
//            $name = $args['id'];
//            return $response->withStatus(200)->withJson(array("user" => $name));
//        });
    });

//    $group->group('/SignUp', function (RouteCollectorProxy $group) {
//        $group->post('/sign-in', \App\modules\Users\Infrastructure\Controllers\SignInController::class);
//        $group->post('/sign-up', \App\modules\Users\Infrastructure\Controllers\SignInController::class);
//    });

};