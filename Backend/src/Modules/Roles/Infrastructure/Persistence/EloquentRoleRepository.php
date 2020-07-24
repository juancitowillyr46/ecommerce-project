<?php
namespace App\Modules\Roles\Infrastructure\Persistence;
use App\Modules\Roles\Domain\Entities\RoleMapperInterface;
use App\Modules\Roles\Domain\Entities\RoleRequestDTO;
use App\Modules\Roles\Domain\Entities\RoleUuid;
use App\Modules\Roles\Domain\Exceptions\RoleNotExistException;
use App\Modules\Roles\Domain\Repositories\RoleRepositoryInterface;
use App\Modules\Roles\Domain\Entities\Role;
use App\Modules\Roles\Domain\Entities\RoleMapper;
use Carbon\Carbon;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;

class EloquentRoleRepository implements RoleRepositoryInterface
{

    private RoleMapperInterface $roleMapper;
    private LoggerInterface $logger;

    public function __construct(RoleMapper $roleMapper, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->roleMapper = $roleMapper;
    }

    public function add(RoleRequestDTO $object): ?RoleUuid
    {
        try {

            $object->uuid = "";

            $data = (array) $this->roleMapper->getMapper()->map($object, Role::class);

            $data['uuid'] = Uuid::uuid1();

            $roleModel = new RoleModel($data);

            if($roleModel->save() == true){
                return $this->roleMapper->getMapper()->map([
                    "uuid" => $roleModel->getAttributeValue('uuid'),
                    "created_at" => Carbon::now()->toDateTimeString()
                ], RoleUuid::class);
            }

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new \Exception("Existe un problema al registrar el recurso");
        }

        return null;
    }

    public function edit(int $id, RoleRequestDTO $object): ?RoleUuid
    {
        try {

            $data = (array) $this->roleMapper->getMapper()->map($object, Role::class);

            $roleModel = RoleModel::findOrFail($id);
            $success = $roleModel->update($data);
            if($success) {
                return $this->roleMapper->getMapper()->map([
                    "uuid" => $roleModel->getAttributeValue('uuid'),
                    "updated_at" => Carbon::now()->toDateTimeString()
                ], RoleUuid::class);
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
            return $this->roleMapper->getMapper()->map($returnData, Role::class);

        } catch (\Exception $e) {

            if($e->getCode() === '23000'){
                throw new \Exception("El recurso no existe en la base de datos");
            } else {
                throw new \Exception("Hubo un problema al encontrar el recurso");
            }
        }

    }


    public function remove(int $id): ?RoleUuid
    {
        try {

            $roleModel = RoleModel::findOrFail($id);
            $roleModel->update(["active" => false]);

            if($roleModel->delete()) {

                return $this->roleMapper->getMapper()->map([
                    "uuid" => $roleModel->getAttributeValue('uuid'),
                    "deleted_at" => Carbon::now()->toDateTimeString()
                ], RoleUuid::class);
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

            $roleModels = RoleModel::where('active', 1)->orderBy('id', 'desc')->get();

            foreach ($roleModels as $roleModel) {
                $roleModel->description = is_null($roleModel->description)? '' : $roleModel->description;
                $roleModel->create_at = is_null($roleModel->create_at)? '' : $roleModel->create_at;
                $roleModel->updated_at = is_null($roleModel->updated_at)? '' : $roleModel->updated_at;
                $returnData = (object) $roleModel->toArray();
                $roles[] = $this->roleMapper->getMapper()->map($returnData, Role::class);
            }

        } catch (\Exception $e) {

            throw new \Exception("Recursos no encontrados");
        }

        return $roles;
    }

    public function findByUuid(string $uuid): int
    {
        $roleModel = RoleModel::where('uuid', $uuid)->first();

        if($roleModel == null) {
            throw new RoleNotExistException();
        }

        return $roleModel->getAttributeValue('id');
    }
}