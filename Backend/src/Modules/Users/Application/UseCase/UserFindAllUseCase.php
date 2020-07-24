<?php
namespace App\Modules\Users\Application\UseCase;

use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserResponse;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class UserFindAllUseCase extends UserUseCaseImp implements UserUseCaseInterface
{
    public function __invoke(): array
    {
        try {

            $result = $this->userRepository->findAll();
            return $this->userMapper->getMapper()->mapMultiple($result, UserResponse::class);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
