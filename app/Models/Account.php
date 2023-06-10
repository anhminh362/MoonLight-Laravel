<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = ['id','email','password','role','verify'];


    public function user(){
        return $this->hasOne(User::class);
    }
//         public function invoice(){
//             return $this->hasMany(Invoice::class);
//         }
}
