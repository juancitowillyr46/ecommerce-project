<?php
namespace App\Modules\Roles\Application\UseCase;

use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\RoleRequestDTO;
use App\Modules\Roles\Domain\RoleResponseDTO;

class RoleEditUseCase extends RoleUseCaseImp implements RoleUseCaseInterface
{
    public function __invoke(int $id, RoleRequestDTO $requestDTO): RoleResponseDTO
    {
        $this->logger->info('Entrando al caso de uso');
        $result = $this->roleRepository->edit($id, $requestDTO);
        return $this->roleMapper->map($result, RoleResponseDTO::class);
    }
}