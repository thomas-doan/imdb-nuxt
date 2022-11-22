<?php

namespace App\Models;

use App\Models\user;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class com extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'commentaire',
        'user_id',
        
    ];

    protected $hidden = [];

    public function user()
{ 
    return $this->belongsTo(user::class); 
}

}
