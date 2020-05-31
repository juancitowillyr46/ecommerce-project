<?php declare(strict_types=1);

namespace App\Domain\BusinessLogic;

use App\Data\Repository\ProductRepository;
use App\Domain\BusinessEntity\DtoRequest\ProductDto;

class ProductLogic {


    private $productRepository_;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository_ = $productRepository;
    }

    public function Create(Array $attr) {

        $productDto = new ProductDto();
        $productDto->id =           $attr['id'];
        $productDto->name =         $attr['name'];
        $productDto->description =  $attr['description'];
        $productDto->price =        $attr['price'];
        $productDto->stock =        $attr['stock'];
        $productDto->category_id =  $attr['category_id'];
        $productDto->status_id =    $attr['status_id'];
        $productDto->created_at =   date("Y-m-d H:i:s");
        $productDto->updated_at =   date("Y-m-d H:i:s");

        $save = $this->productRepository_->Create($productDto);

        return $save;
    }

    public function ReadById(Int $id) {

    }

    public function ReadAll() {
        $all = $this->productRepository_->ReadByAll();
        return $all;
    }

    public function Update(Int $id, ProductDto $productDto) {

    }

    public function Delete(Int $id) {

    }


}