<?php
namespace App\Modules\Roles\Domain;

use App\Modules\Roles\Application\RoleRequestDTO;

interface IRoleRepository
{
    public function add(RoleRequestDTO $object): Role;

    public function edit(Int $id, RoleRequestDTO $object): Role;

    public function findById(Int $id): Role;

    public function findAll(RoleRequestDTO $object): array;

    public function remove(int $id): Role;
}