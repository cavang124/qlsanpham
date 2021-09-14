<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Role extends Model
{
    //
    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}

