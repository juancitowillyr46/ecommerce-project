<?php
declare(strict_types=1);
// use App\Middleware\JwtMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

return function (App $app) {

    $app->get('/', function (ServerRequest $request, Response $response) {
        $name = 'Juan';
        return $response->withStatus(200)->withJson(array("username" => $name));
    });

    (require __DIR__ . '/api/v1.php') ($app);

};