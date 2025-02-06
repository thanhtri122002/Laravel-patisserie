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

    //constant for status

    public const PENDING = 0;
    public const UNPAID = 1;
    public const PAID = 2;
    public const CANCELLED = 3;

    protected $fillable = [
        'phone_number',
        'address',
        'email',
        'payment_method',
        'order_code',
        'cost'
    ];

    protected $guarded = [
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
        return match($this->payment_method) {
            self::PAYMENT_METHOD_CREDIT_CARD => 'Credit Card',
            self::PAYMENT_METHOD_PAYPAL => 'PayPal',
            self::PAYMENT_METHOD_BANK_TRANSFER => 'Bank Transfer',
            self::PAYMENT_METHOD_CASH => 'Cash',
            default => 'Unknown',
        };
    }

    public function getStatusName(): string {
        return match($this->status) {
            self::PENDING => "Pending",
            self::UNPAID => "Unpaid",
            self::PAID => "Paid",
            self::CANCELLED => "Cancelled"
        };
    }

    
}
