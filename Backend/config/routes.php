<?php declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api', function (RouteCollectorProxy $group) {
        (require __DIR__ . '/../src/Modules/SignIn/Infrastructure/routes.php') ($group);
        (require __DIR__ . '/../src/Modules/SignUp/Infrastructure/routes.php') ($group);
        (require __DIR__ . '/../src/Modules/Users/Infrastructure/routes.php') ($group);
        (require __DIR__ . '/../src/Modules/Roles/Infrastructure/routes.php') ($group);
    });
};