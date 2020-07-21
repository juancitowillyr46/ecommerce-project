<?php
namespace App\Modules\Users\Application\UseCase;

use App\Core\Application\BaseUseCase;
use App\core\Infrastructure\Security\EncryptPassword;
use App\Modules\Users\Domain\Entities\UserMapperInterface;
use App\Modules\Users\Domain\Entities\UserRequest;
use App\Modules\Users\Domain\Repositories\UserRepositoryInterface;
use Psr\Log\LoggerInterface;

class UserUseCaseImp extends BaseUseCase
{
    protected UserRepositoryInterface $userRepository;
    protected UserMapperInterface $userMapper;

    public function __construct(LoggerInterface $logger, UserRepositoryInterface $userRepository, UserMapperInterface $userMapper)
    {
        $this->userRepository = $userRepository;
        $this->userMapper = $userMapper;
        parent::__construct($logger);
    }

    public function encryptPassword(UserRequest $userRequest): string {
        return EncryptPassword::encrypt($userRequest->password);
    }
}