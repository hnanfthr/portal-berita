<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // INI PENYELAMATNYA (Biar gak 404)
    public function getRouteKeyName()
    {
        return 'slug';
    }
}