<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Setup de configuraciones
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Set up repositories
$repositories = require __DIR__ . '/../config/repositories.php';
$repositories($containerBuilder);

// Construyendo el contenedor de instancia de dependencias
$container = $containerBuilder->build();

// Creando la instancia en la APP
$app = $container->get(App::class);


// Registrando rutas
/*(require __DIR__ . '/routes.php') ($app);*/

(require __DIR__ . '/../src/core/infrastructure/http/routes.php') ($app);

// Registrando middleware
// (require __DIR__ . '/middlewares.php') ($app);

return $app;
