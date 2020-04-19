<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    protected $fillable = [
        'category', 'subcategory', 'name', 'quantity', 'width', 'height', 'depth', 'comment', 'cabinet_id', 'room_id'
    ];
    public function rooms() {
        return $this->belongsToMany(Room::class);
      }
}
