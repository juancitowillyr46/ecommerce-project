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
        $categoryData->save();
        return $attr;
    }

    public function ReadById(Int $id) {
        $category = CategoryModel::find($id);
        return $category;
    }

    public function ReadByAll() {
        return CategoryModel::all();
    }

    public function Update(Int $id, CategoryDto $attr) {
        $category = CategoryModel::find($id);
        $category->name = $attr->name;
        $category->description = $attr->description;
        $category->slug = $attr->slug;
        $category->image = $attr->image;
        $category->updated_at = $attr->updated_at;
        $category->save();
        return $attr;
    }

    public function Delete(Int $id, CategoryDto $attr) {
        $category = CategoryModel::find($id);
        $category->deleted_at = $attr->deleted_at;
        $category->save();
        return $attr;
    }

}