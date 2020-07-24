<?php
namespace App\Modules\Roles\Domain\Repositories;

use App\Modules\Roles\Domain\Entities\Role;
use App\Modules\Roles\Domain\Entities\RoleRequestDTO;
use App\Modules\Roles\Domain\Entities\RoleUuid;

interface RoleRepositoryInterface
{
    public function add(RoleRequestDTO $object): ?RoleUuid;

    public function edit(int $id, RoleRequestDTO $object): ?RoleUuid;

    public function findById(int $id): ?Role;

    public function findAll(): array;

    public function remove(int $id): ?RoleUuid;

    public function findByUuid(string $uuid): int;
}