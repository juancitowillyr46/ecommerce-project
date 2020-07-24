<?php
namespace App\Modules\SignIn\Domain\Entities;

use App\Core\Domain\BaseAutoMapper;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;

class SignInMapper extends BaseAutoMapper implements SignInMapperInterface
{
    public AutoMapperInterface $autoMapper;
    public AutoMapperConfigInterface $config;

    public function __construct(AutoMapperInterface $autoMapper)
    {
        parent::__construct($autoMapper);
    }

    public function registerMapping() {

        // Http Request -> Entity Request
        $this->config->registerMapping(\stdClass::class, SignInRequest::class);

        // Entity Request -> Entity
        $this->config->registerMapping(SignInRequest::class, SignIn::class)
            ->withNamingConventions(
                new CamelCaseNamingConvention(),
                new SnakeCaseNamingConvention()
            );

        $this->config->registerMapping(\stdClass::class, SignIn::class);

        $this->config->registerMapping('array', SignIn::class);
    }
}