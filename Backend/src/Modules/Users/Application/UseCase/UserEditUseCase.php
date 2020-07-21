<?php


namespace App\Modules\Users\Application\UseCase;


use App\core\Infrastructure\Security\EncryptPassword;
use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserRequest;
use App\Modules\Users\Domain\Entities\UserResponse;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class UserEditUseCase extends UserUseCaseImp implements UserUseCaseInterface
{
    public function __invoke(int $id, UserRequest $userRequest): ?UserResponse
    {
        try {

            $userRequest->password = $this->encryptPassword($userRequest);
            $result = $this->userRepository->edit($id, $userRequest);
            return $this->userMapper->getMapper()->map($result, UserResponse::class);

        } catch (UnregisteredMappingException $e) {
            throw new \Exception($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

//    public function encryptPassword(UserRequest $userRequest): string {
//        return EncryptPassword::encrypt($userRequest->password);
//    }
}