<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'status', 'subtotal', 'shipping_cost',
        'total', 'currency', 'shipping_address', 'billing_address',
        'notes', 'stripe_payment_intent',
    ];

    protected $casts = [
        'shipping_address' => 'array',
        'billing_address' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'delivered' => 'sage',
            'processing', 'paid', 'shipped' => 'gold',
            'cancelled' => 'wine',
            default => 'ink',
        };
    }
}
