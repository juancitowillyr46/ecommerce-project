<?php
declare(strict_types=1);

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {

    $containerBuilder->addDefinitions([
        \App\Modules\SignIn\Domain\SignInRepository::class => \DI\autowire(\App\Modules\SignIn\Infrastructure\Persistence\EloquentSignInRepository::class),
        \App\Modules\SignUp\Domain\SignUpRepository::class => \DI\autowire(\App\Modules\SignUp\Infrastructure\Persistence\EloquentSignUpRepository::class),
        \App\Modules\Users\Domain\Repositories\UsersRepository::class => \DI\autowire(\App\Modules\Users\Infrastructure\Persistence\EloquentUsersRepository::class),

        /* Roles */
        \App\Modules\Roles\Application\RoleUseCaseInterface::class =>  \DI\autowire(\App\Modules\Roles\Application\UseCase\RoleUseCaseImp::class),
        \App\Modules\Roles\Domain\RoleRepositoryInterface::class => \DI\autowire(\App\Modules\Roles\Infrastructure\Persistence\EloquentRoleRepository::class),
        \App\Modules\Roles\Domain\RoleMapperInterface::class => \DI\autowire(\App\Modules\Roles\Domain\RoleMapper::class),
        \App\Modules\Roles\Domain\RoleValidatorInterface::class => \DI\autowire(\App\Modules\Roles\Infrastructure\RoleValidator::class),
    ]);

};