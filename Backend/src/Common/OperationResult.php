<?php declare(strict_types=1);

namespace App\Common;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Slim\Http\Response;

class OperationResult {

    public $data;
    public $error;
    private $response;

    public function __construct($data, Response $response)
    {   
        $this->response = $response;
        $this->data = $data;
    }
    
    public function Ok(){
        $responseDto = new ResponseDTO();
        $responseDto->status = 200;
        $responseDto->data = $this->data;
        return $this->response->withStatus(200)->withJson($responseDto);
    }

    public function Created() {
        $responseDto = new ResponseDTO();
        $responseDto->status = 201;
        $responseDto->data = $this->data;
        return $this->response->withStatus(201)->withJson($responseDto);
    }

    public function BadRequest() {
        $responseDto = new ResponseDTO();
        $responseDto->status = 400;
        $responseDto->error = 'BadRequest';
        return $this->response->withStatus(400)->withJson($responseDto);
    }

    public function Unauthorized() {
        $responseDto = new ResponseDTO();
        $responseDto->data = $this->data;
        return $this->response->withStatus(401)->withJson($responseDto);
    }

    public function Forbidden() {
        $responseDto = new ResponseDTO();
        $responseDto->data = $this->data;
        return $this->response->withStatus(403)->withJson($responseDto);
    }

    public function NotFound() {
        $responseDto = new ResponseDTO();
        $responseDto->data = $this->data;
        return $this->response->withStatus(404)->withJson($responseDto);
    }

    public function ServerError() {
        $responseDto = new ResponseDTO();
        $responseDto->data = $this->data;
        return $this->response->withStatus(500)->withJson($responseDto);
    }

}