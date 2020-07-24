<?php
namespace App\Modules\Roles\Application\UseCase;

use App\Core\Application\BaseUseCase;
use App\Modules\Roles\Domain\Entities\RoleMapperInterface;
use App\Modules\Roles\Domain\Repositories\RoleRepositoryInterface;
use Psr\Log\LoggerInterface;

class RoleUseCaseImp extends BaseUseCase
{
    protected RoleRepositoryInterface $roleRepository;
    protected RoleMapperInterface $roleMapper;

    public function __construct(LoggerInterface $logger, RoleRepositoryInterface $roleRepository, RoleMapperInterface $roleMapper)
    {
        $this->roleRepository = $roleRepository;
        $this->roleMapper = $roleMapper;
        parent::__construct($logger);
    }

}