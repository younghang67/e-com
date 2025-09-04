<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'product_size_id', 'product_color_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productSize()
    {
        return $this->belongsTo(Size::class);
    }
    public function productColor()
    {
        return $this->belongsTo(Color::class);
    }

}
