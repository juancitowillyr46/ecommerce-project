<?php


namespace App\Core\Infrastructure\Http;


class ResponseSuccessController
{

    public string $message;
    public $data;

    public function __construct($message, $data)
    {
        $this->data = $data;
        $this->message = $message;
    }

}