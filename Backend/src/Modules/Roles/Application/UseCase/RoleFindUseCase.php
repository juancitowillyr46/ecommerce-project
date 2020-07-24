<?php
namespace App\Modules\Roles\Application\UseCase;

use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\Entities\RoleResponseDTO;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class RoleFindUseCase extends RoleUseCaseImp implements RoleUseCaseInterface
{
    public function __invoke(string $uuid): ?RoleResponseDTO
    {

        try {
            $id = $this->roleRepository->findByUuid($uuid);
            $result = $this->roleRepository->findById($id);
            return $this->roleMapper->getMapper()->map($result, RoleResponseDTO::class);
        } catch (UnregisteredMappingException $e) {
            return null;
        }
    }

}