<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Account extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = ['email', 'password', 'role', 'verify'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function authenticate($password)
    {
        return Hash::check($password, $this->password);
    }
}
