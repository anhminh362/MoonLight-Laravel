<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Momo extends Model
{
    use HasFactory;
    protected $fillable = ['partnerCode', 'orderId', 'requestId', 'amount', 'orderInfo', 'orderType', 'transId', 'payType', 'signature'];
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function ticket()
    {
        return $this->belongsTo(\App\Models\Ticket::class);
    }
}
