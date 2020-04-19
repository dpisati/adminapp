<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    protected $fillable = [
        'category', 'subcategory', 'quantity', 'width', 'height', 'depth', 'comment', 'cabinet_id', 'room_id', 'name'
    ];
    public function rooms() {
        return $this->belongsToMany(Room::class);
      }
}
