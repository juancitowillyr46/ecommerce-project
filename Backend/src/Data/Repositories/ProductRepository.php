<?php declare(strict_types=1);

namespace App\Data\Repositories;

use App\Data\Models\ProductModel;
use App\Domain\BusinessEntities\DtoRequest\ProductDto;
use Exception;

class ProductRepository {

    public function Create(ProductDto $attr): Bool {

        try {

            $productData = new ProductModel();
            $productData->id =           $attr->id;
            $productData->name =         $attr->name;
            $productData->description =  $attr->description;
            $productData->price =        $attr->price;
            $productData->stock =        $attr->stock;
            $productData->category_id =  $attr->category_id;
            $productData->status_id =    $attr->status_id;
            $productData->created_at =   date("Y-m-d H:i:s");
            $productData->state_audit_id = $attr->state_audit_id;
            $productData->image = $attr->image;
            $success = $productData->save();
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
            $productData->state_audit_id = $attr->state_audit_id;
            $productData->image = $attr->image;
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