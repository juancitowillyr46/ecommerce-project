<?php
declare(strict_types=1);
use Slim\Routing\RouteCollectorProxy;

return function (RouteCollectorProxy $group) {
    $group->post('/sign-in', \App\Modules\SignIn\Infrastructure\Controllers\SignInController::class);
};