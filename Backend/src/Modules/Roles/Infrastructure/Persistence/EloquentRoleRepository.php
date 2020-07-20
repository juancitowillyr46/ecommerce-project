<?php
namespace App\Modules\Roles\Infrastructure\Persistence;
use App\Modules\Roles\Domain\RoleMapperInterface;
use App\Modules\Roles\Domain\RoleRequestDTO;
use App\Modules\Roles\Domain\RoleRepositoryInterface;
use App\Modules\Roles\Domain\Role;
use App\Modules\Roles\Domain\RoleMapper;
use Psr\Log\LoggerInterface;

class EloquentRoleRepository implements RoleRepositoryInterface
{

    private RoleMapperInterface $roleMapper;
    private LoggerInterface $logger;

    public function __construct(RoleMapper $roleMapper, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->roleMapper = $roleMapper;
    }

    public function add(RoleRequestDTO $object): ?Role
    {

        $this->logger->info('Entrando al repositorio');

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

        return null;
    }

    public function edit(int $id, RoleRequestDTO $object): ?Role
    {
        try {

            $data = (array) $this->roleMapper->map($object, Role::class);

            $roleModel = RoleModel::findOrFail($id);
            $success = $roleModel->update($data);
            if($success) {
                $returnData = (object) $roleModel->toArray();
                return $this->roleMapper->map($returnData, Role::class);
            }

        } catch (\Exception $e) {

            if($e->getCode() === '23000'){
                throw new \Exception("El recurso no existe en la base de datos");
            } else {
                throw new \Exception("Hubo un problema al editar el recurso");
            }

        }

        return null;
    }


    public function findById(int $id): ?Role
    {
        try {

            $roleModel = RoleModel::findOrFail($id);
            $returnData = (object) $roleModel->toArray();
            return $this->roleMapper->map($returnData, Role::class);

        } catch (\Exception $e) {

            if($e->getCode() === '23000'){
                throw new \Exception("El recurso no existe en la base de datos");
            } else {
                throw new \Exception("Hubo un problema al encontrar el recurso");
            }
        }

    }


    public function remove(int $id): ?Role
    {
        try {

            $roleModel = RoleModel::findOrFail($id);
            $roleModel->update(["active" => false]);

            if($roleModel->delete()) {

                $returnData = (object) $roleModel->toArray();
                return $this->roleMapper->map($returnData, Role::class);
            }

        } catch (\Exception $e) {

            throw new \Exception("El recurso no fue encontrado");
        }

        return null;
    }

    public function findAll(): array
    {
        $roles = [];
        try {

            $roleModel = RoleModel::all();

            foreach ($roleModel->all() as $roleModel) {
                $roleModel->description = is_null($roleModel->description)? '' : $roleModel->description;
                $roleModel->create_at = is_null($roleModel->create_at)? '' : $roleModel->create_at;
                $roleModel->updated_at = is_null($roleModel->updated_at)? '' : $roleModel->updated_at;
                $returnData = (object) $roleModel->toArray();
                $roles[] = $this->roleMapper->map($returnData, Role::class);
            }

        } catch (\Exception $e) {

            throw new \Exception("Recursos no encontrados");
        }

//        collect($roles);
        return $roles;
    }

}