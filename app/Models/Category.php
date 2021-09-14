<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Category extends Model
{
    //
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
