<?php


namespace App\Modules\Users\Infrastructure\Controllers;


use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Users\Application\UseCase\UserEditUseCase;
use App\Modules\Users\Application\UserUseCaseInterface;
use App\Modules\Users\Domain\Entities\UserMapperInterface;
use App\Modules\Users\Domain\Entities\UserRequest;
use App\Modules\Users\Domain\Exceptions\UserValidatorInterface;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;

class UserEditController extends BaseController
{
    protected UserUseCaseInterface $useCase;
    protected UserMapperInterface $userMapper;
    protected LoggerInterface $logger;
    protected UserValidatorInterface $userValidator;

    public function __construct(UserEditUseCase $useCase, UserMapperInterface $userMapper, LoggerInterface $logger, UserValidatorInterface $userValidator)
    {

        $this->logger = $logger;
        $this->useCase = $useCase;
        $this->userMapper = $userMapper;
        $this->userValidator = $userValidator;

    }

    public function execute(): Response
    {
        try {

            $body = (object) $this->getParsedBody();
            $args = (object) $this->getArgs();

            $message = $this->userValidator->validatorParsedBody($body);
            if(count($message) > 0){
                return $this->BadRequest($message);
            }

            $result = $this->userMapper->getMapper()->map($body, UserRequest::class);
            $useCase = $this->useCase->__invoke($args->id, $result);

            return $this->Ok($useCase);

        } catch (\Exception $e) {

            return $this->BadRequest($e->getMessage());

        }
    }
}