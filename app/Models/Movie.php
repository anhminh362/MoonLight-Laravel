<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable=['name','avatar','county','description','premiere_date','age_limits','trailer'];
    use HasFactory;
    public function movieCat(){
        return $this->hasMany(MovieCat::class);
    }
    public function like(){
        return $this->hasMany(Like::class);
    }
    public function schedule(){
        return $this->hasMany(Schedule::class);
    }
}
