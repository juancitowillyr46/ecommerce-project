<?php
namespace App\Modules\Roles\Infrastructure\Controllers;
use App\Core\Infrastructure\Http\BaseController;
use App\Modules\Roles\Application\IRoleUseCase;
use App\Modules\Roles\Application\RoleRequestDTO;
use App\Modules\Roles\Domain\Role;
use App\Modules\Roles\Domain\RoleMapper;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class RoleIntegratonController extends BaseController
{
    public IRoleUseCase $useCase;
    protected ServerRequest $request;
    protected Response $response;
    protected RoleMapper $roleMapper;

    public function __construct(IRoleUseCase $useCase, RoleMapper $roleMapper)
    {
        $this->roleMapper = $roleMapper;
        $this->useCase = $useCase;
    }

    public function execute(): Response
    {
        try {

            $body = (object) $this->getParsedBody();

            $userValidator = v::attribute('id', v::intVal())->
                                attribute('name', v::notEmpty())->
                                attribute('active', v::boolVal())->
                                attribute('descriptionRole', v::notEmpty());


            $userValidator->assert($body);

            $result = $this->roleMapper->map($body, RoleRequestDTO::class);

            $useCase = $this->useCase->execute($result);

            return $this->Ok($useCase);

        } catch(NestedValidationException $e) {

            return $this->BadRequest($e->getMessages());

        } catch (\Error $err) {

            return $this->ServerError($err->getMessage());

        } catch (\Exception $e) {

            return $this->BadRequest($e->getMessage());

        }
    }

//    public function execute(): Response
//    {
//
////        $userValidator = v::attribute('id', v::intVal())->
////                            attribute('name', v::notEmpty());
//
////        $user = new \stdClass();
////        $user->id = "asdasdas";
////        $user->name= "";
//
////        try {
////
////            $validate = $userValidator->validate($user);
////
////            $userValidator->assert($user);
////
////            return $this->Ok($user);
////
////        } catch(NestedValidationException $e) {
////
////            return $this->BadRequest($e->getMessages());
////
////        }
//
//
//
////        try {
////
////            $getBodyParsed = $this->getParsedBody();
////            $roleRequestDTO = new RoleRequestDTO($getBodyParsed);
////            $useCase = $this->useCase->execute($roleRequestDTO);
////
////            return $this->Ok($useCase);
////
////        } catch ( \Exception $e ){
////            return $this->BadRequest($e->getMessage());
////        }
//    }
}