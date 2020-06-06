<?php declare(strict_types=1);

namespace App\Domain\BusinessEntities\DtoRequest;

class CategoryDto {
    public $id;
    public $name;
    public $description;
    public $slug;
    public $image;
    public $created_at;
    public $updated_at;
    public $deleted_at;
    public $state_audit_id;

    public function __construct()
    {
        $this->id = 0;
        $this->state_audit_id = 1;
    }
}