<?php
namespace App\Modules\Roles\Application\UseCase;

use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\RoleRequestDTO;
use App\Modules\Roles\Domain\RoleResponseDTO;

class RoleFindUseCase extends RoleUseCaseImp implements RoleUseCaseInterface
{
    public function __invoke(int $id): RoleResponseDTO
    {
        $this->logger->info('Entrando al caso de uso');
        $result = $this->roleRepository->findById($id);
        return $this->roleMapper->map($result, RoleResponseDTO::class);
    }

}