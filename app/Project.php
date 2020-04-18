<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Project extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'type', 'client', 'quote', 'franchise', 'user_id', 'status'
    ];
    public function user() {
        return $this->belongsTo(User::class);
      }
    public function rooms() {
        return $this->hasMany(Room::class);
      }
}