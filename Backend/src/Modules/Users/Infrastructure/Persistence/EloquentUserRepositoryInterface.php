<?php
namespace App\Modules\Users\Infrastructure\Persistence;

use App\Modules\Roles\Domain\Role;
use App\Modules\Roles\Domain\RoleMapper;
use App\Modules\Roles\Domain\RoleMapperInterface;
use App\Modules\Roles\Infrastructure\Persistence\RoleModel;
use App\Modules\Users\Domain\Entities\User;
use App\Modules\Users\Domain\Entities\UserMapperInterface;
use App\Modules\Users\Domain\Entities\UserRequest;
use App\Modules\Users\Domain\Exceptions\UserExistException;
use App\Modules\Users\Domain\Exceptions\UserNotFoundException;
use App\Modules\Users\Domain\Repositories\UserRepositoryInterface;
use Psr\Log\LoggerInterface;


class EloquentUserRepositoryInterface implements UserRepositoryInterface
{

    private UserMapperInterface $userMapper;
    private LoggerInterface $logger;

    public function __construct(UserMapperInterface $userMapper, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->userMapper = $userMapper;
    }

    public function add(UserRequest $object): ?User
    {
        try {

            $this->findByEmail($object->email);

            $this->findByUsername($object->username);

            $data = (array) $this->userMapper->getMapper()->map($object, User::class);
            $userModel = new UserModel($data);

            if($userModel->save() == true){
                $returnData = (object) $userModel->toArray();
                return $this->userMapper->getMapper()->map($returnData, User::class);
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return null;
    }

    public function edit(int $id, UserRequest $userRequest): ?User
    {
        try {

            $data = (array) $this->userMapper->getMapper()->map($userRequest, User::class);

            $userModel = UserModel::findOrFail($id);
            $success = $userModel->update($data);
            if($success) {
                $returnData = (object) $userModel->toArray();
                return $this->userMapper->getMapper()->map($returnData, User::class);
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
        return new User();
    }

    public function findAll(): array
    {
        return [];
    }

    public function remove(int $id): ?User
    {
        return new User();
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
}