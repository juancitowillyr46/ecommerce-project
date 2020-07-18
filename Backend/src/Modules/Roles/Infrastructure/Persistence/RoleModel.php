<?php
namespace App\Modules\Roles\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleModel extends Model
{
    protected $table = 'role';
    protected $fillable = ['id', 'name', 'active', 'created_at', 'updated_at', 'description_role'];
    use SoftDeletes;
}