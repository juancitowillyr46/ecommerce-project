<?php
namespace App\Modules\Users\Domain\Repositories;

use App\Modules\Users\Domain\Entities\User;
use App\Modules\Users\Domain\Entities\UserRequest;
use App\Modules\Users\Domain\Entities\UserUuid;

interface UserRepositoryInterface
{
    public function add(UserRequest $object): ?UserUuid;

    public function edit(int $id, UserRequest $object): ?UserUuid;

    public function findById(int $uuid): ?User;

    public function findAll(): array;

    public function remove(int $id): ?UserUuid;

    public function findByEmail(string $email): ?bool;

    public function findByUsername(string $username): ?bool;

    public function findByUuid(string $uuid): int;
}
