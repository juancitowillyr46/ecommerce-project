<?php
namespace App\Modules\Roles\Application\UseCase;

use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\RoleRequestDTO;
use App\Modules\Roles\Domain\RoleResponseDTO;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class RoleEditUseCase extends RoleUseCaseImp implements RoleUseCaseInterface
{
    public function __invoke(int $id, RoleRequestDTO $requestDTO): ?RoleResponseDTO
    {
        $this->logger->info('Entrando al caso de uso');
        $result = $this->roleRepository->edit($id, $requestDTO);
        try {
            return $this->roleMapper->getMapper()->map($result, RoleResponseDTO::class);
        } catch (UnregisteredMappingException $e) {
            return null;
        }
    }
}