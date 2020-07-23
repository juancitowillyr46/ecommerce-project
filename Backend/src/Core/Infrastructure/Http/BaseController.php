<?php
namespace App\Core\Infrastructure\Http;
use Psr\Log\LoggerInterface;
use Slim\Http\ServerRequest;
use Slim\Http\Response;

abstract class BaseController
{
    /* HTTP */
    protected ServerRequest $request;
    protected Response $response;
    protected array $args = [];
    protected string $message;
//    protected string $message;


    /* Monitor  */
//    protected LoggerInterface $logger;

    abstract public function execute(): Response;

    public function __invoke(ServerRequest $request, Response $response, array $args): Response {

        try {
            $this->request = $request;
            $this->response = $response;
            $this->args = $args;
            return $this->execute();

        } catch (\Error $er) {

            return $this->BadRequest($er->getMessage());

        }

    }

    public function getParsedBody(): array {
        try {
            return $this->request->getParsedBody();
        } catch (\Error $e){
            $concat = $e->getMessage() .' - '.  $e->getCode() .' - '. $e->getFile();
            $this->logger->error($concat);
            return [];
        }
    }

    public function getArgs(): array {
        try {
            return $this->args;
        } catch (\Error $e){
            $concat = $e->getMessage() .' - '.  $e->getCode() .' - '. $e->getFile();
            $this->logger->error($concat);
            return [];
        }

    }

    public function Ok($data) {
        return $this->response->withStatus(200)->withJson($data);
    }

    public function Created(ResponseSuccessController $data) {
        return $this->response->withStatus(201)->withJson($data);
    }

    public function BadRequest(ResponseErrorController $data) {
        return $this->response->withStatus(400)->withJson($data);
    }

    public function Unauthorized($message) {
        return $this->response->withStatus(401)->withJson($message);
    }

    public function Forbidden($message) {
        return $this->response->withStatus(403)->withJson($message);
    }

    public function NotFound($message) {
        return $this->response->withStatus(404)->withJson($message);
    }

    public function ServerError($message = 'Interval server error') {
        return $this->response->withStatus(500)->withJson(array("message" => $message));
    }


}