<?php

namespace App\Models;
use App\Models\com;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
    ];

    protected $hidden = [];

    public function coms() 
{ 
    return $this->hasMany(com::class); 
}

}
