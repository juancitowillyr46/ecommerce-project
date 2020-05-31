<?php declare(strict_types=1);

namespace App\Data\Repository;

use App\Data\Models\ProductModel;
use App\Domain\BusinessEntity\DtoRequest\ProductDto;

class ProductRepository {

    public function Create(ProductDto $attr) {
        $productModel = new ProductModel();
        $productModel->id =           $attr->id;
        $productModel->name =         $attr->name;
        $productModel->description =  $attr->description;
        $productModel->price =        $attr->price;
        $productModel->stock =        $attr->stock;
        $productModel->category_id =  $attr->category_id;
        $productModel->status_id =    $attr->status_id;
        $productModel->created_at =   date("Y-m-d H:i:s");
        // $productModel->updated_at =   date("Y-m-d H:i:s");
        $productModel->save();
        return $attr;
    }

    public function ReadById(Int $id) {

    }

    public function ReadByAll() {
        return ProductModel::all();
    }

    public function Update(Int $id, Array $attr) {

    }

    public function Delete(Int $id) {

    }

}