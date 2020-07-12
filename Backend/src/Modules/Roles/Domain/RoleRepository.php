<?php
namespace App\Modules\Roles\Domain;

use App\Modules\Roles\Application\RoleDTORequest;

interface RoleRepository
{
    public function create(RoleDTORequest $object): Role;

    public function update(Int $id, RoleDTORequest $object): Role;

    public function readById(Int $id): Role;

    public function all(RoleDTORequest $object): array;

    public function delete(RoleDTORequest $object): Role;

}