<?php
namespace App\Modules\Users\Application\Manager;


use App\Modules\Users\Application\UserDTORequest;
use App\Modules\Users\Application\UserDTOResponse;
use App\Modules\Users\Domain\Exceptions\UsersExistException;
use App\Modules\Users\Domain\Repositories\UsersRepository;

class UserCreateUseCase
{
    private UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function execute(UserDTORequest $userDTORequest): UserDTOResponse {
        $exist = $this->usersRepository->readByEmail($userDTORequest);
        if($exist == true) {
            throw new UsersExistException();
        } else {
            $user = $this->usersRepository->create($userDTORequest);
            return new UserDTOResponse($user);
        }

    }
}