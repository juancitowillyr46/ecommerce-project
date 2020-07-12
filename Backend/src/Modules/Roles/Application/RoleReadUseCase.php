<?php


namespace App\Modules\Roles\Application;


use App\Modules\Roles\Domain\RoleRepository;
use Monolog\Logger;

class RoleReadUseCase
{
    private RoleRepository $roleRepository;
    private Logger $logger;

    public function __construct(RoleRepository $roleRepository, Logger $logger)
    {
        $this->roleRepository = $roleRepository;
        $this->logger = $logger;
    }

    public function execute(RoleDTORequest $roleDTORequest): RoleDTOResponse
    {
        try
        {
            $role = $this->roleRepository->readById($roleDTORequest->id);
            return new RoleDTOResponse($role);

        } catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }

    }
}