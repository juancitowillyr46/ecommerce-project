<?php
namespace App\Modules\Users\Domain\Entities;

use AutoMapperPlus\AutoMapperInterface;

interface UserMapperInterface
{
    public function registerMapping();
    public function getMapper(): AutoMapperInterface;
}