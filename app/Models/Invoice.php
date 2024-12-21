<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    //Constant for payment methods
    public const PAYMENT_METHOD_CREDIT_CARD = 1;
    public const PAYMENT_METHOD_PAYPAL = 2;
    public const PAYMENT_METHOD_BANK_TRANSFER = 3;
    public const PAYMENT_METHOD_CASH = 4;

    protected $fillable = [
        'phone number',
        'address',
        'email',
        'payment_method',
        'order_code',
        'cost'
    ];

    protected $guared = [
        'id'
    ];

    public function productDetails(): HasMany
    {
        
        return $this->hasMany(ProductDetail::class);
    }

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);
    }

    public function getPaymentMethodName(): string
    {
        return match($this->payemnt_method) {
            self::PAYMENT_METHOD_CREDIT_CARD => 'Credit Card',
            self::PAYMENT_METHOD_PAYPAL => 'PayPal',
            self::PAYMENT_METHOD_BANK_TRANSFER => 'Bank Transfer',
            self::PAYMENT_METHOD_CASH => 'Cash',
            default => 'Unknown',
        };
    }
}
