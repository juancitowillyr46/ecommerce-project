<?php
namespace App\Modules\Users\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    protected $table = 'user';
    protected $fillable = [
                            'id',
                            'username',
                            'password',
                            'email',
                            'status_id',
                            'token_active',
                            'active',
                            'role_id',
                            'created_at',
                            'updated_at'
    ];
    use SoftDeletes;
}