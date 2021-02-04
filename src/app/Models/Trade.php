<?php

namespace App\Models;

use App\Enums\TradeStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
    ];

    protected $casts = [
        'status' => TradeStatusEnum::class,
    ];

    protected $with = ['buyer'];

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
