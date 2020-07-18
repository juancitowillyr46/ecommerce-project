<?php
declare(strict_types=1);
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

return function (App $app) {
    $app->group('/api', function (RouteCollectorProxy $group) {
        (require __DIR__ . '/../../../../modules/Users/infrastructure/routes.php') ($group);
        (require __DIR__ . '/../../../../modules/SignUp/Infrastructure/routes.php') ($group);
    });
};