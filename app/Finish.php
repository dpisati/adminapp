<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finish extends Model
{
    protected $fillable = [
        'name', 'supplier_id'
    ];
    public function supplier() {
        return $this->belongsTo(Supplier::class);
      }
    public function materials() {
        return $this->belongsToMany(Material::class);
      }
}
