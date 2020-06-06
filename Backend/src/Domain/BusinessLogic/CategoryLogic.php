<?php declare(strict_types=1);

namespace App\Domain\BusinessLogic;

use App\Data\Repositories\CategoryRepository;
use App\Domain\BusinessEntities\DtoRequest\CategoryDto;
use App\Domain\BusinessEntities\DtoResponse\CategoryDtoResponse;
use Exception;

class CategoryLogic {


    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function Create(Array $attr): Bool {

        try {

            $categoryDto = new CategoryDto();
            $categoryDto->id =           $attr['id'];
            $categoryDto->name =         $attr['name'];
            $categoryDto->description =  $attr['description'];
            $categoryDto->slug =         $attr['slug'];
            $categoryDto->image =        $attr['image'];
            $categoryDto->created_at =   date("Y-m-d H:i:s");
            $success = $this->categoryRepository->Create($categoryDto);
            return $success;
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }

    }

    public function ReadById(Int $id): CategoryDtoResponse {

        try {


            $categoryDto = new CategoryDtoResponse();
            $categoryData = $this->categoryRepository->ReadById($id);
            if(!$categoryData){
                return $categoryDto;
            }

            if($categoryDto) {
                $categoryDto->id = $categoryData->id;
                $categoryDto->name = $categoryData->name;
                $categoryDto->description = $categoryData->description;
                $categoryDto->slug = $categoryData->slug;
                $categoryDto->image = $categoryData->image;
                $categoryDto->state = $categoryData->stateAudit->name;
            }

            return $categoryDto;

        } catch(Exception $e) {

            throw new Exception($e->getMessage());

        }

    }

    public function ReadAll(): Array {

        try {

            $categoriesData = $this->categoryRepository->ReadByAll();
            $categories = [];
            foreach ($categoriesData as $categoryData) {
                $categoryDto = new CategoryDtoResponse();
                $categoryDto->id = $categoryData->id;
                $categoryDto->name = $categoryData->name;
                $categoryDto->description = $categoryData->description;
                $categoryDto->slug = $categoryData->slug;
                $categoryDto->image = $categoryData->image;
                $categoryDto->state = $categoryData->stateAudit->name;
                $categories[] = $categoryDto;
            }

            return $categories;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }

    }

    public function Update(Int $id, Array $attr): Bool {

        try {

            $categoryDto = new CategoryDto();
            $categoryData = $this->categoryRepository->ReadById($id);
            if(!$categoryData){
                return $categoryDto;
            }

            $categoryDto->id =           $attr['id'];
            $categoryDto->name =         $attr['name'];
            $categoryDto->description =  $attr['description'];
            $categoryDto->slug =         $attr['slug'];
            $categoryDto->image =        $attr['image'];
            $categoryDto->updated_at =   date("Y-m-d H:i:s");
            $categoryDto->state_audit_id =  $attr['state_audit_id'];
            $success = $this->categoryRepository->Update($id, $categoryDto);
            return $success;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }
        
    }

    public function Delete(Int $id): Bool {
        
        try {

            $categoryDto = new CategoryDto();
            $categoryData = $this->categoryRepository->ReadById($id);
            if(!$categoryData){
                return false;
            }

            $categoryDto->deleted_at = date("Y-m-d H:i:s");
            $update = $this->categoryRepository->Delete($id, $categoryDto);
            return $update;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }


    }


}