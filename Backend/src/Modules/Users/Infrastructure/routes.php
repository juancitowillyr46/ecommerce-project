<?php
declare(strict_types=1);
use Slim\Routing\RouteCollectorProxy;

return function (RouteCollectorProxy $group) {
    $group->group('/users', function (RouteCollectorProxy $group) {
        $group->get('', \App\Modules\Users\Infrastructure\Controllers\UserFindAllController::class);
        $group->post('', \App\Modules\Users\Infrastructure\Controllers\UserAddController::class);
        $group->put('/{uuid}', \App\Modules\Users\Infrastructure\Controllers\UserEditController::class);
        $group->get('/{uuid}', \App\Modules\Users\Infrastructure\Controllers\UserFindController::class);
        $group->delete('/{uuid}', \App\Modules\Users\Infrastructure\Controllers\UserRemoveController::class);
    });
};