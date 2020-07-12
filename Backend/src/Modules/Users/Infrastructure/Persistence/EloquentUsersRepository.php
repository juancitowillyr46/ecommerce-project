<?php


namespace App\Modules\Users\Infrastructure\Persistence;


use App\Modules\Users\Application\UserDTORequest;
use App\Modules\Users\Domain\Repositories\UsersRepository;
use App\Modules\Users\Domain\User;

class EloquentUsersRepository implements UsersRepository
{

    public function create(UserDTORequest $userDTORequest): User
    {
        $user = new User();
        $user->id = 1;
        $user->username = $userDTORequest->username;
        $user->password = $userDTORequest->password;
        $user->email = $userDTORequest->email;
        $user->status_id = $userDTORequest->statusId;
        return $user;
    }

    public function update(int $id, object $object): User
    {
        return new User();
    }

    public function readById(int $id): User
    {
        return new User();
    }

    public function all(object $object): array
    {
        return [];
    }

    public function delete(object $object): User
    {
        return new User();
    }


    public function readByEmail(UserDTORequest $userDTORequest): Bool
    {
        if($userDTORequest->email == "juan.rodas.manez@gmail.com") {
            return true;
        };
        return false;
    }
}