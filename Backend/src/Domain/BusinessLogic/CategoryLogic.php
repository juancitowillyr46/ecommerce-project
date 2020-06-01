<?php declare(strict_types=1);

namespace App\Domain\BusinessLogic;

use App\Data\Repository\CategoryRepository;
use App\Data\Repository\ProductRepository;
use App\Domain\BusinessEntity\DtoRequest\CategoryDto;
use App\Domain\BusinessEntity\DtoRequest\ProductDto;

class CategoryLogic {


    private $categoryRepository_;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository_ = $categoryRepository;
    }

    public function Create(Array $attr) {

        $categoryDto = new CategoryDto();
        $categoryDto->id =           $attr['id'];
        $categoryDto->name =         $attr['name'];
        $categoryDto->description =  $attr['description'];
        $categoryDto->slug =         $attr['slug'];
        $categoryDto->image =        $attr['image'];
        $categoryDto->created_at =   date("Y-m-d H:i:s");
        $categoryDto->updated_at =   date("Y-m-d H:i:s");

        $save = $this->categoryRepository_->Create($categoryDto);

        return $save;
    }

    public function ReadById(Int $id) {
        $read = $this->categoryRepository_->ReadById($id);
        return $read;
    }

    public function ReadAll() {
        $all = $this->categoryRepository_->ReadByAll();
        return $all;
    }

    public function Update(Int $id, Array $attr) {

        $categoryDto = new CategoryDto();
        $categoryDto->id =           $attr['id'];
        $categoryDto->name =         $attr['name'];
        $categoryDto->description =  $attr['description'];
        $categoryDto->slug =         $attr['slug'];
        $categoryDto->image =        $attr['image'];
        $categoryDto->updated_at =   date("Y-m-d H:i:s");

        $update = $this->categoryRepository_->Update($id, $categoryDto);
        return $update;
    }

    public function Delete(Int $id) {
        $categoryDto = new CategoryDto();
        $categoryDto->deleted_at = date("Y-m-d H:i:s");
        $update = $this->categoryRepository_->Delete($id, $categoryDto);
        return $update;
    }


}