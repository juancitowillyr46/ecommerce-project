<?php
namespace App\Modules\Roles\Application\UseCase;

use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\Entities\RoleUuid;

class RoleRemoveUseCase extends RoleUseCaseImp implements RoleUseCaseInterface
{
    public function __invoke(string $uuid): ?RoleUuid
    {
        try {

            $id = $this->roleRepository->findByUuid($uuid);
            return $this->roleRepository->remove($id);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}