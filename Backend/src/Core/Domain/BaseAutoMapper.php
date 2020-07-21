<?php
namespace App\Core\Domain;
use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

abstract class BaseAutoMapper
{
    public AutoMapperInterface $autoMapper;
    public AutoMapperConfigInterface $config;

    public function __construct(AutoMapperInterface $autoMapper)
    {
        $this->autoMapper = $autoMapper;
        $this->config = $this->autoMapper->getConfiguration();
        $this->registerMapping();
    }

    public function getMapper(): AutoMapperInterface
    {
        return $this->autoMapper;
    }

}