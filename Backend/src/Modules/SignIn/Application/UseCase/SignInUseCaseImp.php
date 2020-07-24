<?php
namespace App\Modules\SignIn\Application\UseCase;

use App\Core\Application\BaseUseCase;
use App\Core\Infrastructure\Security\JwtCustom;
use App\Modules\SignIn\Domain\Entities\SignInMapperInterface;
use App\Modules\SignIn\Domain\Repositories\SignInRepositoryInterface;
use Psr\Log\LoggerInterface;

class SignInUseCaseImp  extends BaseUseCase
{
    protected SignInRepositoryInterface $signInRepository;
    protected SignInMapperInterface $signInMapper;
    protected JwtCustom $jwtCustom;

    public function __construct(LoggerInterface $logger, SignInRepositoryInterface $signInRepository, SignInMapperInterface $signInMapper, JwtCustom $jwtCustom)
    {
        $this->signInRepository = $signInRepository;
        $this->signInMapper = $signInMapper;
        $this->jwtCustom = $jwtCustom;
        parent::__construct($logger);
    }

}