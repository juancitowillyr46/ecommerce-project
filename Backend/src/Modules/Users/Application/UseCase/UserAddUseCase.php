<?php
namespace App\Modules\Users\Application\UseCase;

use App\core\Infrastructure\Security\EncryptPassword;
use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserRequest;
use App\Modules\Users\Domain\Entities\UserResponse;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class UserAddUseCase extends UserUseCaseImp implements UserUseCaseInterface
{
    public function __invoke(UserRequest $userRequest): ?UserResponse
    {
        try {

            $userRequest->password = $this->encryptPassword($userRequest);
            $result = $this->userRepository->add($userRequest);
            return $this->userMapper->getMapper()->map($result, UserResponse::class);

        } catch (UnregisteredMappingException $e) {
            throw new \Exception("El recurso no existe en la base de datos");
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

//    public function encryptPassword(UserRequest $userRequest): string {
//        return EncryptPassword::encrypt($userRequest->password);
//    }
}