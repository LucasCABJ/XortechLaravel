<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'purchase_order_id',
        'sale_price',
        'quantity',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsToThrough(User::class, PurchaseOrder::class);
    }

    public function subtotal(): float
    {
        return $this->sale_price * $this->quantity;
    }
}
