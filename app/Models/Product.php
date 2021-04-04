<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'reference',
        'price',
        'delivery_days',
    ];
    public function sales()
    {
        return $this->belongsToMany('App\Models\Sale');
    }
}
