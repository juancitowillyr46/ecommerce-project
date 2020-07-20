<?php


namespace App\Modules\Roles\Domain;


use AutoMapperPlus\AutoMapperInterface;

interface RoleMapperInterface
{
    public function registerMapping();
    public function getMapper(): AutoMapperInterface;
}