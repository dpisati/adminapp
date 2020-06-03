<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name', 'supplier_id', 'finish', 'stock', 'picture', 'range', 'slug'
    ];
    public function supplier() {
        return $this->belongsTo(Supplier::class);
      }
    public function finishes() {
        return $this->hasMany(Finish::class);
      }
    
}
