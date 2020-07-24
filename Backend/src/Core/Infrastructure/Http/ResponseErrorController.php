<?php
namespace App\Core\Infrastructure\Http;

class ResponseErrorController
{
    public $message;
    public bool $error;
    public $data;

    public function __construct($message, $data)
    {
        $this->data = $data;
        $this->message = $message;
        $this->error = true;
    }
}