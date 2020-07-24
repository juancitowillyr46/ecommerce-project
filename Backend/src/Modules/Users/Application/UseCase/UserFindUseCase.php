<?php
namespace App\Modules\Users\Application\UseCase;

use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserResponse;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class UserFindUseCase extends UserUseCaseImp implements UserUseCaseInterface
{
    public function __invoke(string $uuid): ?UserResponse
    {
        try {

            $id = $this->userRepository->findByUuid($uuid);

            $result = $this->userRepository->findById($id);

            return $this->userMapper->getMapper()->map($result, UserResponse::class);

        } catch (UnregisteredMappingException $e) {
            throw new \Exception($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}