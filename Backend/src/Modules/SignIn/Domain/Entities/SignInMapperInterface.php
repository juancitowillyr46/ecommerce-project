<?php
namespace App\Modules\SignIn\Domain\Entities;

use AutoMapperPlus\AutoMapperInterface;

interface SignInMapperInterface
{
    public function registerMapping();
    public function getMapper(): AutoMapperInterface;
}