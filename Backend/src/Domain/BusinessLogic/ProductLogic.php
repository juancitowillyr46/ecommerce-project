<?php declare(strict_types=1);

namespace App\Domain\BusinessLogic;

use App\Data\Repositories\ProductRepository;
use App\Domain\BusinessEntities\DtoRequest\ProductDto;
use App\Domain\BusinessEntities\DtoResponse\ProductDtoResponse;
use Exception;

class ProductLogic {


    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function Create(Array $attr): Bool {

        try {

            $productDto = new ProductDto();
            $productDto->id =           $attr['id'];
            $productDto->name =         $attr['name'];
            $productDto->description =  $attr['description'];
            $productDto->price =        $attr['price'];
            $productDto->stock =        $attr['stock'];
            $productDto->category_id =  $attr['category_id'];
            $productDto->status_id =    $attr['status_id'];
            $productDto->created_at =   date("Y-m-d H:i:s");
            $productDto->image =  $attr['image'];
            $success = $this->productRepository->Create($productDto);
            return $success;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }
 
    }

    public function ReadById(Int $id): ProductDtoResponse {

        try {

            $productDto = new ProductDtoResponse();
            $productData = $this->productRepository->ReadById($id);
            if(!$productData){
                return $productDto;
            }
            
            if($productData) {
                $productDto->id = $productData->id;
                $productDto->name = $productData->name;
                $productDto->description = $productData->description;
                $productDto->stock = $productData->stock;
                $productDto->price = $productData->price;
                $productDto->category = $productData->category->name;
                $productDto->state = $productData->stateAudit->name;
                $productDto->image = $productData->image;
            }

            return $productDto;

        } catch(Exception $e) {

            throw new Exception($e->getMessage());

        }

    }

    public function ReadAll(): Array {
        $productsData = $this->productRepository->ReadByAll();
        $products = [];
        foreach ($productsData as $productData) {
            $productDto = new ProductDtoResponse();
            $productDto->id = $productData->id;
            $productDto->name = $productData->name;
            $productDto->description = $productData->description;
            $productDto->stock = $productData->stock;
            $productDto->price = floatval($productData->price);
            $productDto->category = $productData->category->name;
            $productDto->state = $productData->stateAudit->name;
            $productDto->image = $productData->image;
            $products[] = $productDto;
        }
        return $products;
    }

    public function Update(Int $id, Array $attr): Bool {

        try {

            $productDto = new ProductDto();
            $productData = $this->productRepository->ReadById($id);
            if(!$productData){
                return false;
            }

            $productDto->id =           $attr['id'];
            $productDto->name =         $attr['name'];
            $productDto->description =  $attr['description'];
            $productDto->price =        $attr['price'];
            $productDto->stock =        $attr['stock'];
            $productDto->category_id =  $attr['category_id'];
            $productDto->status_id =    $attr['status_id'];
            $productDto->updated_at =   date("Y-m-d H:i:s");
            $productDto->state_audit_id =  $attr['state_audit_id'];
            $productDto->image =  $attr['image'];
            $success = $this->productRepository->Update($id, $productDto);
            return $success;
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }


    }

    public function Delete(Int $id): Bool {

        try {
            
            $productDto = new ProductDto();
            $productData = $this->productRepository->ReadById($id);
            if(!$productData){
                return $productDto;
            }

            $productDto->deleted_at = date("Y-m-d H:i:s");
            $success = $this->productRepository->Delete($id, $productDto);
            return $success;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }

    }


}