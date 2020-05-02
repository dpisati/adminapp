<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $fillable = [
        'sub_category_id', 'name', 'quantity', 'min_width', 'min_height', 'min_depth', 'max_width', 'max_height', 'max_depth', 'comment', 'type', 'measure_type'
    ];
    public function subcategory() {
        return $this->belongsTo('App\SubCategory', 'sub_category_id');
    }
}
