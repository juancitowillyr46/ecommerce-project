<?php declare(strict_types=1);

namespace App\Service\RestApi\Controllers;

use App\Common\OperationResult;
use App\Domain\BusinessLogic\ProductLogic;
use Exception;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\Psr7\Response as Psr7Response;

class ProductController {

    private $productLogic; 

    public function __construct(ProductLogic $productLogic)
    {
        $this->productLogic = $productLogic;
    }

    public function Create(ServerRequest $request, Response $response): Response {

        $requestData = (array) $request->getParsedBody();
        $logic = null;

        $operationResult = new OperationResult($logic, $response);
        
        try { 

            $logic = $this->productLogic->Create($requestData);
            $operationResult->data = $logic;
            $httpResponse = $operationResult->Created();

        } catch (Exception $e) {

            $httpResponse = $operationResult->BadRequest();
        }

        return $httpResponse;

    }

    public function ReadById(ServerRequest $request, Response $response, array $args = []) {

        $logic = null;
        $operationResult = new OperationResult($logic, $response);

        try {

            $logic = $this->productLogic->ReadById((int) $args['id']);
            if($logic->id == 0){
                $operationResult->message = 'Producto no encontrado';
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

    public function ReadAll(ServerRequest $request, Response $response) {

        $logic = null;
        $operationResult = new OperationResult($logic, $response);

        try {

            $logic = $this->productLogic->ReadAll();
            if(count($logic) == 0){
                $operationResult->message = 'No existen productos';
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

            $logic = $this->productLogic->Update((int) $args['id'], $requestData);
            if($logic == false){
                $operationResult->message = 'Producto no encontrado';
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

            $logic = $this->productLogic->Delete((int) $args['id']);
            if($logic == false){
                $operationResult->message = 'Producto no encontrado';
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
