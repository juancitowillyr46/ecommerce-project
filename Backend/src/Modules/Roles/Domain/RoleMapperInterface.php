<?php


namespace App\Modules\Roles\Domain;


interface RoleMapperInterface
{
    public function registerMapping();
    public function map($source, string $destinationClass);
    public function mapMultiple($source, string $destinationClass);
}