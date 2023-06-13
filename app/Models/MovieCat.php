<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieCat extends Model
{
    use HasFactory;
    protected $table='movie_cats';
    public function movie()
    {
        return $this->belongsTo(\App\Models\Movie::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
