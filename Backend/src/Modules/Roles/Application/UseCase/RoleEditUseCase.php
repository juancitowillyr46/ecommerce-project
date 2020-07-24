<?php
namespace App\Modules\Roles\Application\UseCase;

use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\Entities\RoleRequestDTO;
use App\Modules\Roles\Domain\Entities\RoleUuid;


class RoleEditUseCase extends RoleUseCaseImp implements RoleUseCaseInterface
{
    public function __invoke(string $uuid, RoleRequestDTO $requestDTO): ?RoleUuid
    {

        try {

            $id = $this->roleRepository->findByUuid($uuid);
            return $this->roleRepository->edit($id, $requestDTO);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}