<?php
namespace App\Modules\Users\Application\UseCase;

use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserUuid;

class UserRemoveUseCase extends UserUseCaseImp implements UserUseCaseInterface
{
    public function __invoke(string $uuid): ?UserUuid
    {
        try {

            $id = $this->userRepository->findByUuid($uuid);

            return $this->userRepository->remove($id);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}