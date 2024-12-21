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

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function invoices(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function carts(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    
}
