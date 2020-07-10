<?php
namespace App\Modules\Users\Domain\Repositories;

use App\Core\Infrastructure\Repository;
use App\Modules\Users\Application\UserDTORequest;
use App\Modules\Users\Domain\User;

interface UsersRepository
{
    public function create(UserDTORequest $object): User;

    public function update(Int $id, UserDTORequest $object): User;

    public function readById(Int $id): User;

    public function readByEmail(UserDTORequest $object): Bool;

    public function all(Object $object): array;

    public function delete(Object $object): User;
}
