<?php
declare(strict_types=1);
use Slim\Routing\RouteCollectorProxy;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

return function (RouteCollectorProxy $group) {
    $group->group('/roles', function (RouteCollectorProxy $group) {
        $group->post('', \App\Modules\Roles\Infrastructure\Controllers\RoleCreateController::class);
        $group->get('/{id}', \App\Modules\Roles\Infrastructure\Controllers\RoleReadController::class);
        $group->put('/{id}', \App\Modules\Roles\Infrastructure\Controllers\RoleUpdateController::class);
        $group->get('', \App\Modules\Roles\Infrastructure\Controllers\RoleReadAllController::class);
    });
};