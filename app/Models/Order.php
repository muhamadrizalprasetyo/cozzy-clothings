<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'guest_name',
        'guest_email',
        'guest_phone',
        'guest_address',
        'shipping_address',
        'total_price',
        'status',
        'payment_status',
        'payment_method',
        'snap_token',
        'midtrans_order_id',
        'tracking_number',
        'courier',
        'paid_at',
        'shipped_at',
        'completed_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(OrderHistory::class)->latest();
    }

    public static function generateOrderNumber(): string
    {
        return 'CZY-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
    }
}
