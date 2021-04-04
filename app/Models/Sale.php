<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'purchase_at',
        'amount',
        'delivery_days',
    ];

    protected $dates = [
        'purchase_at',
    ];

    public function products()
    {
        return $this->BelongsToMany('App\Models\Product', 'sale_product')->withPivot('price', 'quantity', 'amount')->withTimestamps();
    }

    public function routeNotificationForSlack()
    {
    }
}
