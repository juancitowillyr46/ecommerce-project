<?php
declare(strict_types=1);
use Slim\Routing\RouteCollectorProxy;

return function (RouteCollectorProxy $group) {
    $group->group('/roles', function (RouteCollectorProxy $group) {
        $group->post('', \App\Modules\Roles\Infrastructure\Controllers\RoleCreateController::class);
        $group->get('/{uuid}', \App\Modules\Roles\Infrastructure\Controllers\RoleReadController::class);
        $group->put('/{uuid}', \App\Modules\Roles\Infrastructure\Controllers\RoleUpdateController::class);
        $group->get('', \App\Modules\Roles\Infrastructure\Controllers\RoleReadAllController::class);
        $group->delete('/{uuid}', \App\Modules\Roles\Infrastructure\Controllers\RoleDeleteController::class);
    });
};