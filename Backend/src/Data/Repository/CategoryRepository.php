<?php declare(strict_types=1);

namespace App\Data\Repository;

use App\Data\Models\CategoryModel;
use App\Data\Models\ProductModel;
use App\Domain\BusinessEntity\DtoRequest\CategoryDto;
use App\Domain\BusinessEntity\DtoRequest\ProductDto;

class CategoryRepository {

    public function Create(CategoryDto $attr) {

        $categoryData = new CategoryModel(); 
        $categoryData->name = $attr->name;
        $categoryData->description = $attr->description;
        $categoryData->slug = $attr->slug;
        $categoryData->image = $attr->image;
        $categoryData->created_at = $attr->created_at;
        // $categoryData->updated_at = $attr->updated_at;
        $categoryData->save();
        return $attr;
    }

    public function ReadById(Int $id) {

    }

    public function ReadByAll() {
        return CategoryModel::all();
    }

    public function Update(Int $id, Array $attr) {

    }

    public function Delete(Int $id) {

    }

}