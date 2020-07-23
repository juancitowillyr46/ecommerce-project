<?php
namespace App\Modules\Roles\Domain;
use App\Core\Domain\BaseAutoMapper;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;

class RoleMapper extends BaseAutoMapper implements RoleMapperInterface
{
    public AutoMapperInterface $autoMapper;
    public AutoMapperConfigInterface $config;

    public function __construct(AutoMapperInterface $autoMapper)
    {
        parent::__construct($autoMapper);
    }

    public function registerMapping() {

        // Http Request -> Entity Request
        $this->config->registerMapping(\stdClass::class, RoleRequestDTO::class);

        // Entity Request -> Entity
        $this->config->registerMapping(RoleRequestDTO::class, Role::class)
            ->withNamingConventions(
                new CamelCaseNamingConvention(),
                new SnakeCaseNamingConvention()
            );

        $this->config->registerMapping(\stdClass::class, Role::class);

        // Entity -> Entity ResponseSuccessController
        $this->config->registerMapping(Role::class, RoleResponseDTO::class)
            ->withNamingConventions(
                new SnakeCaseNamingConvention(),
                new CamelCaseNamingConvention()
            )->forMember('active', function (\App\Modules\Roles\Domain\Role $source) {
                return ($source->active == true)? 'ACTIVE' : 'NO ACTIVE';
            });

        $this->config->registerMapping('array', RoleResponseDTO::class);

    }

}