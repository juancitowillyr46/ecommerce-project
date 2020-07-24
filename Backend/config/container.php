<?php declare(strict_types=1);

//use App\Domain\Security\Service\JwtCustom;
use App\Core\Application\UseCaseInterface;
use Psr\Container\ContainerInterface;
use Selective\Config\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;
use \Firebase\JWT\JWT;

return [
    Configuration::class => function() {
        return new Configuration(require __DIR__ . '/settings.php');
    },
    App::class => function (ContainerInterface $container){
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        $settings = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'db_ecommerce',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'flags' => [
                // Turn off persistent connections
                PDO::ATTR_PERSISTENT => false,
                // Enable Exceptions
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // Emulate prepared statements
                PDO::ATTR_EMULATE_PREPARES => true,
                // Set default fetch mode to array
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // Set character set
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
            ],
        ];

        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($settings);
    
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $app;
    },
    \Psr\Log\LoggerInterface::class => function(ContainerInterface $container)
    {
        $config = $container->get(Configuration::class);
        $logger = new Monolog\Logger("APP_WEB");
        $logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../logs/app.log', \Monolog\Logger::DEBUG));
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

//        $config = $container->get(Configuration::class);
        $secret = 'manager';
        $exp = "+1 minutes";
        return new \App\Core\Infrastructure\Security\JwtCustom($secret, $exp);
    }


];