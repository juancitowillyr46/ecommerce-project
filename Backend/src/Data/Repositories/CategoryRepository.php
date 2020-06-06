<?php declare(strict_types=1);

namespace App\Data\Repositories;

use App\Data\Models\CategoryModel;
use App\Domain\BusinessEntities\DtoRequest\CategoryDto;
use Exception;

class CategoryRepository {

    public function Create(CategoryDto $attr): Bool {

        try {

            $categoryData = new CategoryModel(); 
            $categoryData->name = $attr->name;
            $categoryData->description = $attr->description;
            $categoryData->slug = $attr->slug;
            $categoryData->image = $attr->image;
            $categoryData->created_at = $attr->created_at;
            $categoryData->state_audit_id = $attr->state_audit_id;
            $success = $categoryData->save();
            return $success;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());

        }
        

    }

    public function ReadById(Int $id) {
        $category = CategoryModel::find($id);
        return $category;
    }

    public function ReadByAll() {
        return CategoryModel::all();
    }

    public function Update(Int $id, CategoryDto $attr): Bool {
        $category = CategoryModel::find($id);
        $category->name = $attr->name;
        $category->description = $attr->description;
        $category->slug = $attr->slug;
        $category->image = $attr->image;
        $category->updated_at = $attr->updated_at;
        $category->state_audit_id = $attr->state_audit_id;
        $success = $category->save();
        return $success;
    }

    public function Delete(Int $id, CategoryDto $attr): Bool {
        $category = CategoryModel::find($id);
        $category->deleted_at = $attr->deleted_at;
        $success = $category->save();
        return $success;
    }

}