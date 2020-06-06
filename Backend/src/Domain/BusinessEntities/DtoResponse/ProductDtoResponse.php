<?php declare(strict_types=1);

namespace App\Domain\BusinessEntity\DtoResponse;

class ProductDtoResponse {

    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $category;
    public $state;
    public $image;
    
    public function __construct()
    {
        $this->id = 0;
        $this->price = 0;
    }

}