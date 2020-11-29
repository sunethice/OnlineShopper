<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingCarts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id', 'user_id', 'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
