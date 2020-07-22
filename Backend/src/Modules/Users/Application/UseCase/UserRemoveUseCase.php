<?php


namespace App\Modules\Users\Application\UseCase;


use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserResponse;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class UserRemoveUseCase extends UserUseCaseImp implements UserUseCaseInterface
{
    public function __invoke(int $id): ?UserResponse
    {
        try {

            $result = $this->userRepository->remove($id);
            return $this->userMapper->getMapper()->map($result, UserResponse::class);

        } catch (UnregisteredMappingException $e) {
            throw new \Exception($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}