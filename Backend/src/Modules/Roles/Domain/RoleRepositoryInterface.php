<?php
namespace App\Modules\Roles\Domain;

interface RoleRepositoryInterface
{
    public function add(RoleRequestDTO $object): ?Role;

    public function edit(int $id, RoleRequestDTO $object): ?Role;

    public function findById(int $id): ?Role;

    public function findAll(): array;

    public function remove(int $id): ?Role;
}