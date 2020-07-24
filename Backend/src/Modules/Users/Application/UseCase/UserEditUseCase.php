<?php
namespace App\Modules\Users\Application\UseCase;

use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserRequest;
use App\Modules\Users\Domain\Entities\UserResponse;
use App\Modules\Users\Domain\Entities\UserUuid;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class UserEditUseCase extends UserUseCaseImp implements UserUseCaseInterface
{
    public function __invoke(string $uuid, UserRequest $userRequest): ?UserUuid
    {
        try {

            $id = $this->userRepository->findByUuid($uuid);

            $userRequest->password = $this->encryptPassword($userRequest);
            return $this->userRepository->edit($id, $userRequest);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}