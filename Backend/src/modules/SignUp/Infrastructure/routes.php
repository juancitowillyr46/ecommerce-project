<?php
declare(strict_types=1);
use Slim\Routing\RouteCollectorProxy;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

return function (RouteCollectorProxy $group) {
    $group->post('/sign-up', \App\Modules\SignUp\Infrastructure\SignUpController::class);
};