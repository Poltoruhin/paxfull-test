<?php
declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\TradeStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int amount
 * @property float rate
 * @property TradeStatusEnum status
 * @property PaymentMethodEnum payment_method_name
 * @property User buyer
 * @property User seller
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
    ];

    protected $casts = [
        'status' => TradeStatusEnum::class,
        'payment_method_name' => PaymentMethodEnum::class,
        'rate' => 'float',
    ];

    protected $with = ['buyer'];

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
