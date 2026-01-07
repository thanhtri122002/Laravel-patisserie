<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'stripe_product_id',
        'stripe_price_id'
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

    public function scopeGetNewProducts(Builder $query, $limit): void
    {
        $query->orderBy('created_at', 'desc')->limit($limit);
    }

    public function scopeGetTopSelling(Builder $query, $limit): void
    {
        $query->join('product_details', 'products.id', '=', 'product_details.id')
            ->join('invoices', 'invoices.id', '=', 'product_details.invoice_id')
            ->where('invoices.status', Invoice::PAID)
            ->selectRaw('COUNT(product_details.id) as total_quantity')
            ->select(
                'products.name',
                'products.description',
                'products.price'    
            )
            ->groupBy(
                'products.name',
                'products.description',
                'products.price'
            )
            ->orderBy('total_quantity', 'desc')
            ->limit($limit);
    }

    public function scopeGetMostProfitableProducts(Builder $query, $limit): void
    {
        $query->join('product_details', 'products.id', '=', 'product_details.id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID)
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.description'
            )
            ->selectRaw('SUM(product_details.cost) as total_profit')
            ->groupBy(
                'products.id',
                'products.name',
                'products.price',
                'products.description'
            )
            ->orderby('total_sold', 'desc')
            ->limit($limit);
    }

    public function scopeGetCurrentMonthNewProducts(Builder $query): void
    {   
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $query->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear);
    }

    public function scopeGetProductsInPriceRange(Builder $query, $min, $max): void
    {
        $query->whereBetween('price', [$min, $max]);
    }

    public function scopeGetOutOfStock(Builder $query): void
    {
        $query->where('quantity', 0);
    }

    public function scopeGetDiscountProducts(Builder $query): void
    {
        $query->where('discount', '>', 0.0);
    }

    public function scopeGetProductsBySearching(Builder $query, $inputString): void
    {
        $pattern = '%' . $inputString . '%';
        $query->where(function ($product) use ($pattern) {
            $product->whereLike('name', $pattern)
                ->orWhereHas('category', function ($category) use ($pattern) {
                    $category->whereLike('name', $pattern);
                });
        });
    }
    public function scopeOrderByCreatedDate(Builder $query, $order): void
    {
        $query->orderBy('created_at', $order);
    }
    public function scopeOrderByStock(Builder $query, $order): void
    {
        $query->orderBy('stock', $order);
    }
}
