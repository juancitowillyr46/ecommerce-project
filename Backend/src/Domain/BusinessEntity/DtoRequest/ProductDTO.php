<?php declare(strict_types=1);

namespace App\Domain\BusinessEntity\DtoRequest;

class ProductDto {

    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $category_id;
    public $status_id;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->id = 0;
    }

}