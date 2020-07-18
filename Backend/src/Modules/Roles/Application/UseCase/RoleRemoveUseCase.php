<?php
namespace App\Modules\Roles\Application;

use App\Core\Application\BaseRequest;
use App\Core\Application\DtoResponseData;
use App\Modules\Roles\Domain\Role;

class RoleRemoveUseCase extends BaseUseCase
{
    public function execute(BaseRequest $dtoRequest): DtoResponseData
    {
        try
        {

            $data = $dtoRequest->getData();
            $roleDtoRequestData = new RoleDtoRequestData($data);
            $role = new Role();
            $role = $this->roleRepository->delete($roleDtoRequestData->id);

            return new RoleDTOResponseData($role);

        } catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }
}