<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable=['ticket_id','user_id','code','total_price'];

    use HasFactory;
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
    public function ticket(){
        return $this->belongsTo(\App\Models\Ticket::class);
    }
}
