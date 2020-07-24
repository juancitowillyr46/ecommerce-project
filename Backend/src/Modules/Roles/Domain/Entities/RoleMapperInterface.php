<?php
namespace App\Modules\Roles\Domain\Entities;

use AutoMapperPlus\AutoMapperInterface;

interface RoleMapperInterface
{
    public function registerMapping();
    public function getMapper(): AutoMapperInterface;
}