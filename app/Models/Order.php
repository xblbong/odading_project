<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //fillable fields
    protected $guarded = [];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
