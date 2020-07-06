<?php
declare(strict_types=1);
use Slim\Routing\RouteCollectorProxy;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

return function (RouteCollectorProxy $group) {

    $group->group('/security', function (RouteCollectorProxy $group) {
        $group->post('/sign-in', \App\modules\security\infrastructure\controllers\SignInController::class);
        $group->post('/sign-up', \App\modules\security\infrastructure\controllers\SignUpController::class);
    });

};