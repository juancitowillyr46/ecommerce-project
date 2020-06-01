<?php declare(strict_types=1);

namespace App\Domain\BusinessEntity\DtoRequest;

class CategoryDto {
    public $id;
    public $name;
    public $description;
    public $slug;
    public $image;
    public $created_at;
    public $updated_at;
    public $deleted_at;
}