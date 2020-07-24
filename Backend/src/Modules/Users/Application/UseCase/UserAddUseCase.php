<?php
namespace App\Modules\Users\Application\UseCase;

use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserRequest;
use App\Modules\Users\Domain\Entities\UserUuid;

class UserAddUseCase extends UserUseCaseImp implements UserUseCaseInterface
{
    public function __invoke(UserRequest $userRequest): UserUuid
    {
        try {

            $userRequest->password = $this->encryptPassword($userRequest);
            return $this->userRepository->add($userRequest);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}