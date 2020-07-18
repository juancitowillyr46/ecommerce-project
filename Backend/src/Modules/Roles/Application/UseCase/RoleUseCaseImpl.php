<?php
namespace App\Modules\Roles\Application\UseCase;

use App\Core\Application\BaseUseCase;
use App\Modules\Roles\Application\IRoleUseCase;
use App\Modules\Roles\Application\RoleRequestDTO;
use App\Modules\Roles\Application\RoleResponseDTO;
use App\Modules\Roles\Domain\IRoleRepository;
use App\Modules\Roles\Domain\RoleMapper;
use App\Modules\Roles\Infrastructure\Persistence\RoleModel;
use Psr\Log\LoggerInterface;
use Respect\Validation\Validator as v;

class RoleUseCaseImpl extends BaseUseCase implements IRoleUseCase
{
    private IRoleRepository $roleRepository;
    private RoleMapper $roleMapper;

    public function __construct(LoggerInterface $logger, IRoleRepository $roleRepository, RoleMapper $roleMapper)
    {
        $this->roleRepository = $roleRepository;
        $this->roleMapper = $roleMapper;
        parent::__construct($logger);
    }

    public function execute(RoleRequestDTO $requestDTO): RoleResponseDTO
    {

        try {

            $done = $this->roleRepository->add($requestDTO);

            return $this->roleMapper->map($done, RoleResponseDTO::class);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}