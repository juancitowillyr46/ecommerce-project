<?php
namespace App\Modules\Users\Infrastructure\Persistence;

use App\Modules\Roles\Domain\Repositories\RoleRepositoryInterface;
use App\Modules\Users\Domain\Entities\User;
use App\Modules\Users\Domain\Entities\UserMapperInterface;
use App\Modules\Users\Domain\Entities\UserRequest;
use App\Modules\Users\Domain\Entities\UserUuid;
use App\Modules\Users\Domain\Exceptions\UserExistException;
use App\Modules\Users\Domain\Exceptions\UserNotExistException;
use App\Modules\Users\Domain\Repositories\UserRepositoryInterface;
use Carbon\Carbon;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;


class EloquentUserRepositoryInterface implements UserRepositoryInterface
{

    private UserMapperInterface $userMapper;
    private RoleRepositoryInterface $roleRepository;
    private LoggerInterface $logger;

    public function __construct(UserMapperInterface $userMapper, LoggerInterface $logger, RoleRepositoryInterface $roleRepository)
    {
        $this->logger = $logger;
        $this->userMapper = $userMapper;
        $this->roleRepository = $roleRepository;
    }

    public function add(UserRequest $object): ?UserUuid
    {
        try {

            $this->findByEmail($object->email);

            $this->findByUsername($object->username);

            $object->roleId = $this->roleRepository->findByUuid($object->roleUuid);

            $object->uuid = "";

            $data = (array) $this->userMapper->getMapper()->map($object, User::class);

            $data['uuid'] = Uuid::uuid1();

            $userModel = new UserModel($data);

            if($userModel->save() == true){
              return $this->userMapper->getMapper()->map([
                    "uuid" => $userModel->getAttributeValue('uuid'),
                    "created_at" => Carbon::now()->toDateTimeString()
              ], UserUuid::class);
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return null;
    }

    public function edit(int $id, UserRequest $userRequest): ?UserUuid
    {
        try {

            $userRequest->roleId = $this->roleRepository->findByUuid($userRequest->roleUuid);

            $data = (array) $this->userMapper->getMapper()->map($userRequest, User::class);

            $userModel = UserModel::findOrFail($id);

            $success = $userModel->update($data);

            if($success) {
                return $this->userMapper->getMapper()->map([
                    "uuid" => $userModel->getAttributeValue('uuid'),
                    "updated_at" => Carbon::now()->toDateTimeString()
                ], UserUuid::class);
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

    public function findById(int $id): ?User
    {
        try {


            $userModel = UserModel::findOrFail($id);
            $userModel->role;
            $returnData = (object) $userModel->toArray();
            return $this->userMapper->getMapper()->map($returnData, User::class);

        } catch (\Exception $e) {

            if($e->getCode() === '23000'){
                throw new \Exception("El recurso no existe en la base de datos");
            } else {
                throw new \Exception("Hubo un problema al encontrar el recurso");
            }
        }
    }

    public function findAll(): array
    {
        $users = [];
        try {

            $userModels = UserModel::where('active', 1)->orderBy('id', 'desc')->get();
            foreach ($userModels as $userModel) {
                $userModel->role;
                $returnData = (object) $userModel->toArray();
                $users[] = $this->userMapper->getMapper()->map($returnData, User::class);
            }

        } catch (\Exception $e) {

            $this->logger->error($e->getMessage());
            throw new \Exception("Recursos no encontrados");
        }

        return $users;
    }

    public function remove(int $id): ?UserUuid
    {
        try {

            $userModel = UserModel::findOrFail($id);
            $userModel->update(["active" => false]);
            if($userModel->delete()) {
                return $this->userMapper->getMapper()->map([
                    "uuid" => $userModel->getAttributeValue('uuid'),
                    "deleted_at" => Carbon::now()->toDateTimeString()
                ], UserUuid::class);
            }

        } catch (\Exception $e) {

            throw new \Exception("El recurso no fue encontrado");
        }

        return null;
    }

    public function findByEmail(string $email): ?bool
    {
        $userModel = UserModel::where('email', $email)->first();

        if($userModel != null) {
            throw new UserExistException();
        }
        return false;
    }

    public function findByUsername(string $username): ?bool
    {
        $userModel = UserModel::where('username', $username)->first();

        if($userModel != null) {
            throw new UserExistException();
        }

        return false;
    }

//    public function addRelations($userModel) {
//        return $userModel->role;
//    }
    public function findByUuid(string $uuid): int
    {
        $userModel = UserModel::where('uuid', $uuid)->first();

        if($userModel == null) {
            throw new UserNotExistException();
        }

        return $userModel->getAttributeValue('id');
    }
}