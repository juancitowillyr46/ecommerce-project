<?php


namespace App\Modules\Roles\Application;


use App\Modules\Roles\Domain\RoleRepository;
use Monolog\Logger;

class RoleFindUseCase
{
    private RoleRepository $roleRepository;
    private Logger $logger;

    public function __construct(RoleRepository $roleRepository, Logger $logger)
    {
        $this->roleRepository = $roleRepository;
        $this->logger = $logger;
    }

    public function execute(RoleDTORequest $roleDTORequest): RoleDTOResponseData
    {
        try
        {
            $role = $this->roleRepository->readById($roleDTORequest->id);
            return new RoleDTOResponseData($role);

        } catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }

    }
}