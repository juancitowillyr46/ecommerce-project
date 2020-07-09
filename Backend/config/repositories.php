<?php
declare(strict_types=1);



use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        \App\modules\security\domain\ISignUpRepository::class => \DI\autowire(\App\modules\security\infrastructure\persistence\EloquentSignUpRepository::class),
        \App\modules\security\domain\ISignInRepository::class => \DI\autowire(\App\modules\security\infrastructure\persistence\EloquentSignInRepository::class),
    ]);
};