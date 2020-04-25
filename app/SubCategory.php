<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'name', 'category_id'
    ];
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function cabinets() {
        return $this->hasMany(Library::class);
    }
}
