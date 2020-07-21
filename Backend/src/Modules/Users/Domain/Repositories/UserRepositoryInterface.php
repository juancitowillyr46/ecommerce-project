<?php
namespace App\Modules\Users\Domain\Repositories;

use App\Modules\Users\Domain\Entities\User;
use App\Modules\Users\Domain\Entities\UserRequest;

interface UserRepositoryInterface
{
    public function add(UserRequest $object): ?User;

    public function edit(int $id, UserRequest $object): ?User;

    public function findById(int $id): ?User;

    public function findAll(): array;

    public function remove(int $id): ?User;

    public function findByEmail(string $email): ?bool;

    public function findByUsername(string $username): ?bool;
}
