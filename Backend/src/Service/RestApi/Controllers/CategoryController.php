<?php declare(strict_types=1);

namespace App\Service\RestApi\Controllers;

use App\Common\OperationResult;
use App\Domain\BusinessLogic\CategoryLogic;
use Exception;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

class CategoryController {

    private $categoryLogic; 

    public function __construct(CategoryLogic $categoryLogic)
    {
        $this->categoryLogic = $categoryLogic;
    }

    public function Create(ServerRequest $request, Response $response): Response {

        $requestData = (array) $request->getParsedBody();
        $logic = null;

        $operationResult = new OperationResult($logic, $response);
        
        try { 

            $logic = $this->categoryLogic->Create($requestData);
            $operationResult->data = $logic;
            $httpResponse = $operationResult->Created();

        } catch (Exception $e) {

            $httpResponse = $operationResult->BadRequest();
        }

        return $httpResponse;
        

    }

    public function ReadById(ServerRequest $request, Response $response, array $args = []): Response {

        $logic = null;
        $operationResult = new OperationResult($logic, $response);

        try {

            $logic = $this->categoryLogic->ReadById((int) $args['id']);
            if($logic->id == 0){
                $operationResult->message = 'Categoria no encontrada';
                $httpResponse = $operationResult->NotFound();
            } else {
                $operationResult->data = $logic;
                $httpResponse = $operationResult->Ok();
            }

        } catch (Exception $e) {

            $httpResponse = $operationResult->BadRequest();

        }

        return $httpResponse;

    }

    public function ReadAll(ServerRequest $request, Response $response): Response {

        $logic = null;
        $operationResult = new OperationResult($logic, $response);

        try {

            $logic = $this->categoryLogic->ReadAll();
            if(count($logic) == 0){
                $operationResult->message = 'No existen categorias';
                $httpResponse = $operationResult->NotFound();
            } else {
                $operationResult->data = $logic;
                $httpResponse = $operationResult->Ok();
            }

        } catch (Exception $e) {

            $httpResponse = $operationResult->BadRequest();

        }

        return $httpResponse;

    }

    public function Update(ServerRequest $request, Response $response, array $args = []) {

        $requestData = (array) $request->getParsedBody();
        $logic = null;

        $operationResult = new OperationResult($logic, $response);
        
        try { 

            $logic = $this->categoryLogic->Update((int) $args['id'], $requestData);
            if($logic == false){
                $operationResult->message = 'Categoria no encontrado';
                $httpResponse = $operationResult->NotFound();
            } else {
                $operationResult->data = $logic;
                $httpResponse = $operationResult->Ok();
            }

        } catch (Exception $e) {

            $httpResponse = $operationResult->BadRequest();
        }

        return $httpResponse;

    }

    public function Delete(ServerRequest $request, Response $response, array $args = []) {

        $logic = null;
        $operationResult = new OperationResult($logic, $response);

        try { 

            $logic = $this->categoryLogic->Delete((int) $args['id']);
            if($logic == false){
                $operationResult->message = 'Categoria no encontrado';
                $httpResponse = $operationResult->NotFound();
            } else {
                $operationResult->data = $logic;
                $httpResponse = $operationResult->Ok();
            }

        } catch (Exception $e) {

            $httpResponse = $operationResult->BadRequest();
        }

        return $httpResponse;

    }
    
}
