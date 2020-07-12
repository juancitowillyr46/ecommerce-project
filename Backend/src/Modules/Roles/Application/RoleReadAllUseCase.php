<?php


namespace App\Modules\Roles\Application;


use App\Modules\Roles\Domain\RoleRepository;
use Monolog\Logger;

class RoleReadAllUseCase
{
    private RoleRepository $roleRepository;
    private Logger $logger;

    public function __construct(RoleRepository $roleRepository, Logger $logger)
    {
        $this->roleRepository = $roleRepository;
        $this->logger = $logger;
    }

    public function execute(RoleDTORequest $roleDTORequest): array
    {
        try
        {
            $roles = $this->roleRepository->all($roleDTORequest);
            $roleCollection = [];

            foreach ($roles as $role) {
                $roleCollection[] = new RoleDTOResponse($role);
            }

            return $roleCollection;

        } catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }

    }
}