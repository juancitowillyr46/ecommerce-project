<?php


namespace App\Modules\Users\Infrastructure\Controllers;


use App\Core\Infrastructure\Http\BaseController;
use App\Core\Infrastructure\Http\ResponseErrorController;
use App\Core\Infrastructure\Http\ResponseSuccessController;
use App\Modules\Users\Application\UseCase\UserFindUseCase;
use App\Modules\Users\Application\UseCase\UserRemoveUseCase;
use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserMapperInterface;
use App\Modules\Users\Domain\Exceptions\UserValidatorInterface;
use App\Modules\Users\Infrastructure\UserMessagesController;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;

class UserRemoveController extends BaseController
{
    protected UserUseCaseInterface $useCase;
    protected UserMapperInterface $userMapper;
    protected LoggerInterface $logger;
    protected UserValidatorInterface $userValidator;

    public function __construct(UserRemoveUseCase $useCase, UserMapperInterface $userMapper, LoggerInterface $logger, UserValidatorInterface $userValidator)
    {

        $this->logger = $logger;
        $this->useCase = $useCase;
        $this->userMapper = $userMapper;
        $this->userValidator = $userValidator;
        parent::__construct($logger);
    }

    public function execute(): Response
    {
        try {

            $args = (object) $this->getArgs();

            $uuid = $this->useCase->__invoke($args->uuid);

            return $this->Ok(new ResponseSuccessController(UserMessagesController::REMOVE, $uuid));

        } catch (\Exception $e) {

            return $this->BadRequest(new ResponseErrorController($e->getMessage(), ''));

        }
    }
}