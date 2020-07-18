<?php
namespace App\Modules\Roles\Infrastructure\Persistence;
use App\Modules\Roles\Application\RoleRequestDTO;
use App\Modules\Roles\Domain\IRoleRepository;
use App\Modules\Roles\Domain\Role;
use App\Modules\Roles\Domain\RoleMapper;

class EloquentRoleRepository implements IRoleRepository
{

    private RoleMapper $roleMapper;

    public function __construct(RoleMapper $roleMapper)
    {
        $this->roleMapper = $roleMapper;
    }

    public function add(RoleRequestDTO $object): Role
    {

        try {

            $data = (array) $this->roleMapper->map($object, Role::class);
            $roleModel = new RoleModel($data);

            if($roleModel->save() == true){
                $returnData = (object) $roleModel->toArray();
                return $this->roleMapper->map($returnData, Role::class);
            }

        } catch (\Exception $e) {
            throw new \Exception("Existe un problema al registrar el recurso");
        }


//        $object = new Role($object->toArray());
//
//        $object->
////        return $object->only();
//
////        $role = new Role();
//
//        try
//        {
//            $roleModel = new RoleModel();
//
////            $attr = $roleModel->getFillable();
//
////            $success = $roleModel->save();
////            if($success) {
////                $role->id = $roleModel->getAttribute('id');
////                $role->name = $object->name;
////                $role->active = $object->active;
////                return $role;
////            }
//
//        } catch (\Exception $e)
//        {
//            throw new \Exception($e->getMessage());
//        }
//
//        return $object->only();


    }

//    public function create(RoleDTORequest $object): Role
//    {
//        $role = new Role();
//
//        try
//        {
//            $roleModel = new RoleModel($object->toArray());
//            $success = $roleModel->save();
//            if($success) {
//                $role->id = $roleModel->getAttribute('id');
//                $role->name = $object->name;
//                $role->active = $object->active;
//                return $role;
//            }
//
//        } catch (\Exception $e)
//        {
//            throw new \Exception($e->getMessage());
//        }
//
//        return $role;
//
//    }
//
//    public function update(int $id, RoleDTORequest $object): Role
//    {
//        $role = new Role();
//
//        try {
//
//            $roleModel = RoleModel::findOrFail($id);
//            $success = $roleModel->update($object->toArray());
//            if($success) {
//                $role->id = $roleModel->getAttribute('id');
//                $role->name = $object->name;
//                $role->active = $object->active;
//            }
//
//        } catch (\Exception $e) {
//
//            throw new \Exception("Hubo un problema al editar el recurso");
//        }
//
//        return $role;
//    }
//
//    public function readById(int $id): Role
//    {
//        $role = new Role();
//
//        try {
//
//            $roleModel = RoleModel::findOrFail($id);
//            $role->id = $roleModel->getAttribute('id');
//            $role->name = $roleModel->getAttribute('name');
//            $role->active = $roleModel->getAttribute('active');
//
//        } catch (\Exception $e) {
//
//            throw new \Exception("El recurso no fue encontrado");
//        }
//
//        return $role;
//    }
//
//    public function all(RoleDTORequest $object): array
//    {
//        $roles = [];
//
//        try {
//
//            $roleModel = RoleModel::all();
//
//            foreach ($roleModel->all() as $roleModel) {
//                $role = new Role();
//                $role->id = $roleModel->getAttribute('id');
//                $role->name = $roleModel->getAttribute('name');
//                $role->active = $roleModel->getAttribute('active');
//                $roles[] = $role;
//            }
//
//        } catch (\Exception $e) {
//
//            throw new \Exception("El recurso no fue encontrado");
//        }
//
//        return $roles;
//    }
//
//    public function delete(int $id): Role
//    {
//
//        $role = new Role();
//
//        try {
//
//            $roleModel = RoleModel::findOrFail($id);
//            $roleModel->update(["active" => false]);
//
//            if($roleModel->delete()) {
//                $role->id = $roleModel->getAttribute('id');
//                $role->name = $roleModel->getAttribute('name');
//                $role->active = $roleModel->getAttribute('active');
//            }
//
//        } catch (\Exception $e) {
//
//            throw new \Exception("El recurso no fue encontrado");
//        }
//
//        return $role;
//    }

    public function edit(int $id, RoleRequestDTO $object): Role
    {
        return new Role();
    }

    public function findById(int $id): Role
    {
        return new Role();
    }

    public function findAll(RoleRequestDTO $object): array
    {
        return [];
    }

    public function remove(int $id): Role
    {
        return new Role();
    }
}