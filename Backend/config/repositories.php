<?php
declare(strict_types=1);

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {

    $containerBuilder->addDefinitions([
        /* Roles */
        \App\Modules\Roles\Application\RoleUseCaseInterface::class =>  \DI\autowire(\App\Modules\Roles\Application\UseCase\RoleUseCaseImp::class),
        \App\Modules\Roles\Domain\RoleRepositoryInterface::class => \DI\autowire(\App\Modules\Roles\Infrastructure\Persistence\EloquentRoleRepository::class),
        \App\Modules\Roles\Domain\RoleMapperInterface::class => \DI\autowire(\App\Modules\Roles\Domain\RoleMapper::class),
        \App\Modules\Roles\Domain\RoleValidatorInterface::class => \DI\autowire(\App\Modules\Roles\Infrastructure\RoleValidator::class),

        /* Users */
        \App\Modules\Users\Application\UserUseCaseInterface::class =>  \DI\autowire(\App\Modules\Users\Application\UseCase\UserUseCaseImp::class),
        \App\Modules\Users\Domain\Repositories\UserRepositoryInterface::class => \DI\autowire(\App\Modules\Users\Infrastructure\Persistence\EloquentUserRepositoryInterface::class),
        \App\Modules\Users\Domain\Entities\UserMapperInterface::class => \DI\autowire(\App\Modules\Users\Domain\Entities\UserMapper::class),
        \App\Modules\Users\Domain\Exceptions\UserValidatorInterface::class => \DI\autowire(\App\Modules\Users\Infrastructure\UserValidator::class)
    ]);

};