<?php
namespace App\Modules\Roles\Application\UseCase;

use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\RoleRequestDTO;
use App\Modules\Roles\Domain\RoleResponseDTO;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class RoleFindUseCase extends RoleUseCaseImp implements RoleUseCaseInterface
{
    public function __invoke(int $id): ?RoleResponseDTO
    {
        $this->logger->info('Entrando al caso de uso');
        $result = $this->roleRepository->findById($id);
        try {
            return $this->roleMapper->getMapper()->map($result, RoleResponseDTO::class);
        } catch (UnregisteredMappingException $e) {
            return null;
        }
    }

}