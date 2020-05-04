<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name', 'supplier_id'
    ];
    public function supplier() {
        return $this->belongsTo(Supplier::class);
      }
}
