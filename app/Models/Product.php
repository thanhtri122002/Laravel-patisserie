<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        
        ];
        
    protected $guarded = [
        'id',
        'stripe_product_id',
        'stripe_price_id'
    ];

    public function category(): BelongsTo
    {
        
        return $this->belongsTo(Category::class);
    }

    public function productDetails(): HasMany
    {

        return $this->hasMany(ProductDetail::class)->chaperone();
    }

    public function productImages(): HasMany
    {

        return $this->hasMany(ProductImage::class)->chaperone();
    }
}
