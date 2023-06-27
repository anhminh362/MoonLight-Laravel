<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['schedule_id','status'];
    use HasFactory;
    public function schedule(){
        return $this->belongsTo(\App\Models\Schedule::class);
    }
    public function invoice(){
        return $this->hasOne(\App\Models\Invoice::class);
    }
}
