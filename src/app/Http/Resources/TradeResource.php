<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Trade;
use App\Services\CurrencyExchangeHelper;
use App\Services\MoneyFormatter;
use Illuminate\Http\Resources\Json\JsonResource;

class TradeResource extends JsonResource
{
    public function __construct(Trade $trade)
    {
        parent::__construct($trade);
    }

    public function toArray($request): array
    {
        /** @var CurrencyExchangeHelper $currencyExchangeHelper */
        $currencyExchangeHelper = resolve(CurrencyExchangeHelper::class);
        /** @var MoneyFormatter $moneyFormatter */
        $moneyFormatter = resolve(MoneyFormatter::class);

        return [
            'id' => $this->id,
            'amount' => $moneyFormatter->format($currencyExchangeHelper->satoshiToUsd($this->amount, $this->rate)),
            'rate' => $moneyFormatter->format($this->rate),
            'payment_method' => $this->payment_method_name,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'buyer' => $this->buyer,
            'seller' => $this->seller,
        ];
    }
}
