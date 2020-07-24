<?php
namespace App\Modules\Roles\Application\UseCase;

use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\Entities\RoleRequestDTO;
use App\Modules\Roles\Domain\Entities\RoleUuid;

class RoleAddUseCase extends RoleUseCaseImp implements RoleUseCaseInterface
{
    public function __invoke(RoleRequestDTO $requestDTO): RoleUuid
    {
        try {

            return $this->roleRepository->add($requestDTO);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}