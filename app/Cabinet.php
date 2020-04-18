<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    protected $fillable = [
        'category', 'subcategory', 'name', 'quantity', 'width', 'height', 'depth', 'comment'
    ];
    public function rooms() {
        return $this->belongsToMany(Room::class);
      }
}
