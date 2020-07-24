<?php
namespace App\Modules\SignIn\Infrastructure\Controllers;

use App\Core\Infrastructure\Http\BaseController;
use App\Core\Infrastructure\Http\ResponseErrorController;
use App\Core\Infrastructure\Http\ResponseSuccessController;
use App\Modules\SignIn\Application\SignInUseCaseInterface;
use App\Modules\SignIn\Application\UseCase\SignInUseCase;
use App\Modules\SignIn\Domain\Entities\SignInMapperInterface;
use App\Modules\SignIn\Domain\Entities\SignInRequest;
use App\Modules\SignIn\Domain\Exceptions\SignInValidatorInterface;
use App\Modules\SignIn\Infrastructure\SignInMessagesController;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;

class SignInController extends BaseController
{
    protected SignInUseCaseInterface $signInUseCase;
    protected LoggerInterface $logger;
    protected SignInMapperInterface $signInMapper;
    protected SignInValidatorInterface $signInValidator;

    public function __construct(SignInUseCase $signInUseCase, SignInMapperInterface $signInMapper, LoggerInterface $logger, SignInValidatorInterface $signInValidator)
    {
        $this->logger = $logger;
        $this->signInUseCase = $signInUseCase;
        $this->signInMapper = $signInMapper;
        $this->signInValidator = $signInValidator;

        parent::__construct($logger);
    }

    public function execute(): Response
    {

        try {

            $body = (object) $this->request->getParsedBody();

            $message = $this->signInValidator->validatorParsedBody($body);

            if(count($message) > 0){
                return $this->BadRequest(new ResponseErrorController($message, ''));
            }

            $request = $this->signInMapper->getMapper()->map($body, SignInRequest::class);

            $signInResponse = $this->signInUseCase->__invoke($request);

            return $this->Ok(new ResponseSuccessController(SignInMessagesController::OK, $signInResponse));

        } catch (\Exception $e) {

            return $this->BadRequest(new ResponseErrorController($e->getMessage(), ''));
        }

    }

}