<?php
declare(strict_types=1);

use App\Modules\SignIn\Domain\Entities\SignInMapperInterface;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {

    $containerBuilder->addDefinitions([

        /* Roles */
        \App\Modules\Roles\Application\RoleUseCaseInterface::class =>  \DI\autowire(\App\Modules\Roles\Application\UseCase\RoleUseCaseImp::class),
        \App\Modules\Roles\Domain\Repositories\RoleRepositoryInterface::class => \DI\autowire(\App\Modules\Roles\Infrastructure\Persistence\EloquentRoleRepository::class),
        \App\Modules\Roles\Domain\Entities\RoleMapperInterface::class => \DI\autowire(\App\Modules\Roles\Domain\Entities\RoleMapper::class),
        \App\Modules\Roles\Domain\Exceptions\RoleValidatorInterface::class => \DI\autowire(\App\Modules\Roles\Infrastructure\RoleValidator::class),

        /* Users */
        \App\Modules\Users\Application\UserUseCaseInterface::class =>  \DI\autowire(\App\Modules\Users\Application\UseCase\UserUseCaseImp::class),
        \App\Modules\Users\Domain\Repositories\UserRepositoryInterface::class => \DI\autowire(\App\Modules\Users\Infrastructure\Persistence\EloquentUserRepositoryInterface::class),
        \App\Modules\Users\Domain\Entities\UserMapperInterface::class => \DI\autowire(\App\Modules\Users\Domain\Entities\UserMapper::class),
        \App\Modules\Users\Domain\Exceptions\UserValidatorInterface::class => \DI\autowire(\App\Modules\Users\Infrastructure\UserValidator::class),

         /* SignIn */
        \App\Modules\SignIn\Application\SignInUseCaseInterface::class =>  \DI\autowire(\App\Modules\SignIn\Application\UseCase\SignInUseCaseImp::class),
        \App\Modules\SignIn\Domain\Repositories\SignInRepositoryInterface::class => \DI\autowire(\App\Modules\SignIn\Infrastructure\Persistence\EloquentSignInRepositoryInterface::class),
        \App\Modules\SignIn\Domain\Entities\SignInMapperInterface::class => \DI\autowire(\App\Modules\SignIn\Domain\Entities\SignInMapper::class),
        \App\Modules\SignIn\Domain\Exceptions\SignInValidatorInterface::class => \DI\autowire(\App\Modules\SignIn\Infrastructure\SignInValidator::class)

    ]);

};