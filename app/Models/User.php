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
    protected $fillable = ['email','full_name','phone','status','account_id'];
    public function account()
        {
            return $this->belongsTo(\App\Models\Account::class);
        }
    public function like(){
        return $this->hasMany(Like::class);
    }
    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
}
