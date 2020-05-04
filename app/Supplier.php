<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name'
    ];
    public function materials() {
        return $this->hasMany(Material::class);
      }
    public function finishes() {
        return $this->hasMany(Finish::class);
      }
}
