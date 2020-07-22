<?php
namespace App\Modules\Roles\Application\UseCase;
use App\Modules\Roles\Application\RoleUseCaseInterface;
use App\Modules\Roles\Domain\RoleRequestDTO;
use App\Modules\Roles\Domain\RoleResponseDTO;
use AutoMapperPlus\Exception\UnregisteredMappingException;

class RoleAddUseCase extends RoleUseCaseImp implements RoleUseCaseInterface
{
    public function __invoke(RoleRequestDTO $requestDTO): ?RoleResponseDTO
    {
        $result = $this->roleRepository->add($requestDTO);
        try {
            return $this->roleMapper->getMapper()->map($result, RoleResponseDTO::class);
        } catch (UnregisteredMappingException $e) {
            return null;
        }
    }
}