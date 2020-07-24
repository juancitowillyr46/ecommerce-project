<?php
namespace App\Modules\SignIn\Infrastructure\Persistence;

use App\Modules\SignIn\Domain\Entities\SignIn;
use App\Modules\SignIn\Domain\Entities\SignInMapperInterface;
use App\Modules\SignIn\Domain\Entities\SignInRequest;
use App\Modules\SignIn\Domain\Exceptions\SignInNotExistException;
use App\Modules\SignIn\Domain\Repositories\SignInRepositoryInterface;
use App\Modules\Users\Infrastructure\Persistence\UserModel;
use Psr\Log\LoggerInterface;

class EloquentSignInRepositoryInterface implements SignInRepositoryInterface
{

    private SignInMapperInterface $signInMapper;
    private LoggerInterface $logger;

    public function __construct(SignInMapperInterface $signInMapper, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->signInMapper = $signInMapper;

    }

    public function findUserByUsername(SignInRequest $signInRequest): SignIn
    {

        try {

            $userModel = UserModel::where('username', $signInRequest->username)->first();

            // User no existe
            if($userModel == null) {
                throw new SignInNotExistException();
            }

            return $this->signInMapper->getMapper()->map($userModel->toArray(), SignIn::class);

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());

        }

    }
}