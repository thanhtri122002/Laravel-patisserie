<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'cart_id',
        'invoice_id',
        'name',
        'quantity',
        'discount',
        'cost'
    ];

    protected $guarded = [
        'id'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Caluculate the total cost of a productDetail
     * 
     * ProductDetail cost = product's price x quantity - discount (if have)
     * 
     * @return float the final cost of a product detail 
     */
    public function calculateTotal()
    {   
        $cost = $this->product->price * $this->quantity;
        $discount = $this->discount ?? 0;
        return $cost - $discount;
    }
}
