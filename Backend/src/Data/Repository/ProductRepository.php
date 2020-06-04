<?php declare(strict_types=1);

namespace App\Data\Repository;

use App\Data\Models\ProductModel;
use App\Domain\BusinessEntity\DtoRequest\ProductDto;
use App\Domain\BusinessEntity\DtoResponse\ProductDtoResponse;
use Exception;

class ProductRepository {

    public function Create(ProductDto $attr): Bool {

        try {

            $productModel = new ProductModel();
            $productModel->id =           $attr->id;
            $productModel->name =         $attr->name;
            $productModel->description =  $attr->description;
            $productModel->price =        $attr->price;
            $productModel->stock =        $attr->stock;
            $productModel->category_id =  $attr->category_id;
            $productModel->status_id =    $attr->status_id;
            $productModel->created_at =   date("Y-m-d H:i:s");
            $success = $productModel->save();
            return $success;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }

    }

    public function ReadById(Int $id) {

        try {
            
            $productData = ProductModel::find($id);
            return $productData;

        } catch(Exception $e) {

            throw new Exception($e->getMessage());

        }

    }

    public function ReadByAll() {
        return ProductModel::all();
    }

    public function Update(Int $id, ProductDto $attr): Bool {

        try {

            $productData = ProductModel::find($id);
            $productData->id =           $attr->id;
            $productData->name =         $attr->name;
            $productData->description =  $attr->description;
            $productData->price =        $attr->price;
            $productData->stock =        $attr->stock;
            $productData->category_id  = $attr->category_id;
            $productData->status_id    = $attr->status_id;
            $productData->updated_at   = date("Y-m-d H:i:s");
            $success = $productData->save();
            return $success;
            
        } catch(Exception $e) {

            throw new Exception($e->getMessage());

        }

    }

    public function Delete(Int $id, ProductDto $attr): Bool {

        try {

            $productData = ProductModel::find($id);
            $productData->deleted_at = $attr->deleted_at;
            $success = $productData->save();
            return $success;
            
        } catch(Exception $e) {

            throw new Exception($e->getMessage());

        }


    }

}