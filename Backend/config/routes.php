<?php declare(strict_types=1);

use App\Middleware\JwtMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->get('/', '\App\Service\RestApi\Controllers\WelcomeController:Index');

    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->group('/products', function (RouteCollectorProxy $group) {
            $group->post('', '\App\Service\RestApi\Controllers\ProductController:Create');
            $group->get('', '\App\Service\RestApi\Controllers\ProductController:ReadAll');
            $group->get('/{id}', '\App\Service\RestApi\Controllers\ProductController:ReadById');
            $group->put('/{id}', '\App\Service\RestApi\Controllers\ProductController:Update');
            $group->delete('/{id}', '\App\Service\RestApi\Controllers\ProductController:Delete');
        });
        $group->group('/categories', function (RouteCollectorProxy $group) {
            $group->post('', '\App\Service\RestApi\Controllers\CategoryController:Create');
            $group->get('', '\App\Service\RestApi\Controllers\CategoryController:ReadAll');
            $group->get('/{id}', '\App\Service\RestApi\Controllers\CategoryController:ReadById');
            $group->put('/{id}', '\App\Service\RestApi\Controllers\CategoryController:Update');
            $group->delete('/{id}', '\App\Service\RestApi\Controllers\CategoryController:Delete');
        });
    });
    // ->add(JwtMiddleware::class);

};