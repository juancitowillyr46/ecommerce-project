<?php declare(strict_types=1);

namespace App\Data\Models;

class ProductModel extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'product';

    public function category()
    {
        return $this->belongsTo('App\Data\Models\CategoryModel', 'category_id', 'id');
    }

    public function stateAudit()
    {
        return $this->belongsTo('App\Data\Models\StateAuditModel', 'state_audit_id', 'id');
    }
}