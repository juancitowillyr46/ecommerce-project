<?php declare(strict_types=1);

namespace App\Domain\BusinessEntities\DtoRequest;

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
    public $state_audit_id;
    public $image;
    
    public function __construct()
    {
        $this->id = 0;
        $this->state_audit_id = 1;
    }

}