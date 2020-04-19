<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $fillable = [
        'category', 'subcategory', 'name', 'quantity', 'width', 'height', 'depth', 'comment'
    ];
}
