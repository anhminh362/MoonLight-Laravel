<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable=['movie_id','user_id'];

    use HasFactory;
    public function movie()
    {
        return $this->belongsTo(\App\Models\Movie::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
