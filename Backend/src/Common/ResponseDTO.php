<?php declare(strict_types=1);

namespace App\Common;

class ResponseDTO {
    public $message;
    public $data = null;
    public $status;
    public $error;

    public function __construct()
    {
        $this->message = '';
        $this->error = false;
    }

}