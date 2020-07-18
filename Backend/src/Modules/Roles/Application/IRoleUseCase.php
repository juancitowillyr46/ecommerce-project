<?php
namespace App\Modules\Roles\Application;


interface IRoleUseCase
{
    public function execute(RoleRequestDTO $requestDTO): RoleResponseDTO;
}