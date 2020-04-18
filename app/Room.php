<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'project_id'
    ];
    public function project() {
        return $this->belongsTo(Project::class);
      }
    public function cabinets() {
        return $this->belongsToMany(Cabinet::class);
      }
}
