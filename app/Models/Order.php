<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DetailOrder;

class Order extends Model
{
    //
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code', 'user_id', 'total_money', 'total_product', 'status', 'address_order', 'ship'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail(){
        return $this->hasMany(DetailOrder::class);
    }
}

