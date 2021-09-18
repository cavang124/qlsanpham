<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Cart;
use App\Models\DetailOrder;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code',
        'name',
        'image',
        'category_id',
        'price',
        'status',
        'number',
        'date_expired',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageAttribute($image)
    {
        if ($image == null || $image == '') {
            return asset('/img/sunset.jpg');
        }
        return asset($image);
    }

    public function getDateExpiredAttribute($date_expired){
       return date('d-m-Y', strtotime($date_expired));
    }
}
