<?php declare(strict_types=1);

error_reporting(0);
ini_set('display_errors', '0');

date_default_timezone_set('America/Lima');

$settings = [];

$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

$settings['db'] = [
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

$settings['error_handler_middleware'] = [
    'display_error_details' => true,
    'log_errors' => true,
    'log_error_details' => true
];

$settings['jwt'] = [
    "secret" => "manager",
    "exp" => "+1 minutes"
];

$settings['logs'] = [
    "root" => '/../logs/app.log',
    "name" => 'APP_WEB',
    "hola" => $s3_bucket = getenv('DISPLAY')
];



return $settings;