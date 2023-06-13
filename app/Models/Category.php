<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[''];
    public function movieCat(){
        return $this->hasMany(\App\Models\MovieCat::class);
    }

}
