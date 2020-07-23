<?php
namespace App\Modules\Users\Domain\Entities;

use App\Core\Domain\BaseAutoMapper;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;

class UserMapper extends BaseAutoMapper implements UserMapperInterface
{
    public AutoMapperInterface $autoMapper;
    public AutoMapperConfigInterface $config;

    public function __construct(AutoMapperInterface $autoMapper)
    {
        parent::__construct($autoMapper);
    }

    public function registerMapping() {

        // Http Request -> Entity Request
        $this->config->registerMapping(\stdClass::class, UserRequest::class);


        // Entity Request -> Entity
        $this->config->registerMapping(UserRequest::class, User::class)
            ->withNamingConventions(
                new CamelCaseNamingConvention(),
                new SnakeCaseNamingConvention()
            );

        $this->config->registerMapping(\stdClass::class, User::class);


        // Entity -> Entity ResponseSuccessController
        $this->config->registerMapping(User::class, UserResponse::class)
            ->withNamingConventions(
                new SnakeCaseNamingConvention(),
                new CamelCaseNamingConvention()
            )->forMember('active', function (User $source) {
                return ($source->active == true)? 'ACTIVE' : 'NO ACTIVE';
            })->forMember('role', function (User $source) {
                return (count($source->role) > 0 )? $source->role['name']: '';
            });

        $this->config->registerMapping('array', UserUuid::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        );

        $this->config->registerMapping('array', UserResponse::class);

    }
}