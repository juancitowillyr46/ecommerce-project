<?php


namespace App\Modules\Roles\Infrastructure\Persistence;


use App\Modules\Roles\Application\RoleDTORequest;
use App\Modules\Roles\Domain\Role;
use App\Modules\Roles\Domain\RoleRepository;
use Carbon\Carbon;

class EloquentRoleRepository implements RoleRepository
{

    public function create(RoleDTORequest $object): Role
    {
        $role = new Role();

        try
        {
            $roleModel = new RoleModel($object->toArray());
            $success = $roleModel->save();
            if($success) {
                $role->id = $roleModel->getAttribute('id');
                $role->name = $object->name;
                $role->active = $object->active;
                return $role;
            }

        } catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }

        return $role;

    }

    public function update(int $id, RoleDTORequest $object): Role
    {
        $role = new Role();

        try {

            $roleModel = RoleModel::findOrFail($id);
            $success = $roleModel->update($object->toArray());
            if($success) {
                $role->id = $roleModel->getAttribute('id');
                $role->name = $object->name;
                $role->active = $object->active;
            }

        } catch (\Exception $e) {

            throw new \Exception("Hubo un problema al editar el recurso");
        }

        return $role;
    }

    public function readById(int $id): Role
    {
        $role = new Role();

        try {

            $roleModel = RoleModel::findOrFail($id);
            $role->id = $roleModel->getAttribute('id');
            $role->name = $roleModel->getAttribute('name');
            $role->active = $roleModel->getAttribute('active');

        } catch (\Exception $e) {

            throw new \Exception("El recurso no fue encontrado");
        }

        return $role;
    }

    public function all(RoleDTORequest $object): array
    {
        $roles = [];

        try {

            $roleModel = RoleModel::all();

            foreach ($roleModel->all() as $roleModel) {
                $role = new Role();
                $role->id = $roleModel->getAttribute('id');
                $role->name = $roleModel->getAttribute('name');
                $role->active = $roleModel->getAttribute('active');
                $roles[] = $role;
            }

//            return $roles;

        } catch (\Exception $e) {

            throw new \Exception("El recurso no fue encontrado");
        }

        return $roles;
    }

    public function delete(RoleDTORequest $object): Role
    {
        return new Role();
    }
}