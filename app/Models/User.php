<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table='users';

//     public function account(){
//         return $this->hasMany('Account')
//     }
    public function account()
        {
            return $this->belongsTo(\App\Models\Account::class);
        }
}
