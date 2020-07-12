<?php
namespace App\Modules\Roles\Domain;

use Carbon\Carbon;
use Carbon\Traits\Date;

class Role
{
    public int $id;
    public string $name;
    public Carbon $createdAt;
    public Carbon $updatedAt;
    public Carbon $deletedAt;
    public bool $active;

    public function __construct()
    {
        $this->id = 0;
    }

}