<?php declare(strict_types=1);

namespace App\Domain\BusinessLogic;

use App\Data\Repository\ProductRepository;
use App\Domain\BusinessEntity\DtoRequest\ProductDto;
use Exception;

class ProductLogic {


    private $productRepository_;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository_ = $productRepository;
    }

    public function Create(Array $attr) {

        // try {

            $productDto = new ProductDto();
            $productDto->id =           $attr['id'];
            $productDto->name =         $attr['name'];
            $productDto->description =  $attr['description'];
            $productDto->price =        $attr['price'];
            $productDto->stock =        $attr['stock'];
            $productDto->category_id =  $attr['category_id'];
            $productDto->status_id =    $attr['status_id'];
            $productDto->created_at =   date("Y-m-d H:i:s");
            $save = $this->productRepository_->Create($productDto);
            return $save;

        // } catch (Exception $e) {
        //     throw new Exception(['error' => $e->getMessage()]);
        // }

 
    }

    public function ReadById(Int $id) {
        $product = $this->productRepository_->ReadById($id);
        return $product;
    }

    public function ReadAll() {
        $all = $this->productRepository_->ReadByAll();
        return $all;
    }

    public function Update(Int $id, Array $attr) {
        $productDto = new ProductDto();
        $productDto->id =           $attr['id'];
        $productDto->name =         $attr['name'];
        $productDto->description =  $attr['description'];
        $productDto->price =        $attr['price'];
        $productDto->stock =        $attr['stock'];
        $productDto->category_id =  $attr['category_id'];
        $productDto->status_id =    $attr['status_id'];
        $productDto->updated_at =   date("Y-m-d H:i:s");
        $save = $this->productRepository_->Update($id, $productDto);
        return $save;
    }

    public function Delete(Int $id) {
        $productDto = new ProductDto();
        $productDto->deleted_at = date("Y-m-d H:i:s");
        $delete = $this->productRepository_->Delete($id, $productDto);
        return $delete;
    }


}