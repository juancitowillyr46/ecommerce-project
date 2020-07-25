<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Selective\Config\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;

return [
    Configuration::class => function() {
        return new Configuration(require __DIR__ . '/settings.php');
    },
    App::class => function (ContainerInterface $container){

        AppFactory::setContainer($container);
        $app = AppFactory::create();

        /* Setting Connection DB */
        $config = $container->get(Configuration::class);
        $dbSettingsConnection = $config->getArray('db');

        /* Eloquent */
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($dbSettingsConnection);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $app;
    },
    \Psr\Log\LoggerInterface::class => function(ContainerInterface $container)
    {
        $config = $container->get(Configuration::class);
        $logger = new Monolog\Logger($config->getString('logs.name'));
        $logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__. $config->getString('logs.root'), \Monolog\Logger::DEBUG));
        return $logger;
    },
    \AutoMapperPlus\AutoMapperInterface::class => function(ContainerInterface $container)
    {
        $config = new \AutoMapperPlus\Configuration\AutoMapperConfig();
        return new \AutoMapperPlus\AutoMapper($config);
    },
    \Respect\Validation\Validator::class => function(ContainerInterface $container)
    {
        return new \Respect\Validation\Validator();
    },
    \App\Core\Infrastructure\Security\JwtCustom::class => function(ContainerInterface $container) {

        $config = $container->get(Configuration::class);
        $secret = $config->getString('jwt.secret');
        $exp = $config->getString('jwt.exp');

        return new \App\Core\Infrastructure\Security\JwtCustom($secret, $exp);
    }

];