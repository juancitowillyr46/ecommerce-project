<?php


namespace App\Modules\Roles\Application\UseCase;

use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\RoleResponseDTO;

class RoleFindAllUseCase extends RoleUseCaseImp implements RoleUseCaseInterface
{
    public function __invoke(): array
    {
        $result = $this->roleRepository->findAll();
        return $this->roleMapper->getMapper()->mapMultiple($result, RoleResponseDTO::class);
    }
}