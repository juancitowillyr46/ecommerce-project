<?php declare(strict_types=1);

namespace App\Data\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model {
    protected $table = 'category';

    public $id;

    use SoftDeletes;

    public function stateAudit()
    {
        return $this->belongsTo('App\Data\Models\StateAuditModel', 'state_audit_id', 'id');
    }
    
}