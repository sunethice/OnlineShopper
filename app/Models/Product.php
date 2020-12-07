<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'product_id';
    protected $guarded = ['product_id'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

/*
    Add items to the cart and continue shopping
    If the user adds the same item to the cart while continuing to shop, the item count in the shopping cart should get incremented
    All items and their totals should be displayed in the cart
    Taxes as per location should be applied
    A user can add more items to the cart- total should reflect the same
    Update the contents added to the cart- total should reflect that too
    Remove items from the cart
    Proceed to checkout
    Calculate Shipping costs with different shipping options
    Apply coupons
    Don’t check out, close the site, and come back later. The site should retain the items in the cart
*/
