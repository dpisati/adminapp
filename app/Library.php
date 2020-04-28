<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $fillable = [
        'category', 'subcategory', 'name', 'quantity', 'width', 'height', 'depth', 'comment', 'type', 'subcategory_id'
    ];
    public function subcategory() {
        return $this->belongsTo('App\SubCategory', 'sub_category_id');
    }
}
