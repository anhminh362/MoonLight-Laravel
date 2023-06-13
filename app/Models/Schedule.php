<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public function movie(){
        return  $this->belongsTo(\App\Models\Movie::class);
    }
    public function room(){
        return $this->belongsTo(\App\Models\Room::class);
    }
    public  function ticket(){
        return $this->hasMany(\App\Models\Ticket::class);
    }
}
