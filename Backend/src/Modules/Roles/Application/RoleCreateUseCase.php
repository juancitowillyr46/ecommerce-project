<?php
namespace App\Modules\Roles\Application;

use App\Core\Application\UseCase;
use App\Modules\Roles\Domain\RoleRepository;
use Monolog\Logger;

class RoleCreateUseCase
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
            $role = $this->roleRepository->create($roleDTORequest);
            return new RoleDTOResponse($role);

        } catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }

    }

    public function validate(array $validateRequest): RoleDTORequest
    {

        if(empty($validateRequest)){
            throw new \Exception('El servicio debe recibir parámetros en el body de la petición');
        }

        if(empty($validateRequest['name'])) {
            throw new \Exception('los campos del servicio son requeridos');
        }

        try
        {
            return new RoleDTORequest($validateRequest);

        } catch (\Error $e) {
            $concat = "Message: ".$e->getMessage() . " | Code: ". $e->getCode() . " | Line: ". $e->getLine() . " | FileName: ". $e->getFile();
            $this->logger->error($concat);
            throw new \Error($concat);
        }
    }

}