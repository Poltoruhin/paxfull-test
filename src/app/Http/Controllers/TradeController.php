<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PaymentMethodEnum;
use App\Enums\TradeStatusEnum;
use App\Http\Requests\StoreTradeRequest;
use App\Http\Resources\TradeResource;
use App\Models\Trade;
use App\Models\User;
use App\Services\BtcPriceProvider;
use App\Services\CurrencyExchangeHelper;
use App\Services\MoneyTransferManager;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TradeController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/trades",
     *      operationId="getTradesList",
     *      tags={"Trades"},
     *      summary="Get list of trades",
     *      description="Returns list of trades",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TradeCollection")
     *       )
     *     )
     */
    public function index(): AnonymousResourceCollection
    {
        return TradeResource::collection(Trade::all());
    }

    /**
     * @OA\Get(
     *      path="/api/trades/{id}",
     *      operationId="getTradeById",
     *      tags={"Trades"},
     *      summary="Get trade information",
     *      description="Returns trade data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Trade id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Trade")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */
    public function show(Trade $trade): TradeResource
    {
        return TradeResource::make($trade);
    }

    /**
     * @OA\Post(
     *      path="/api/trades",
     *      operationId="storeTrade",
     *      tags={"Trades"},
     *      summary="Store new trade",
     *      description="Store new trade",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreTradeRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Trade")
     *       )
     * )
     */
    public function store(
        StoreTradeRequest $request,
        BtcPriceProvider $btcPriceProvider,
        CurrencyExchangeHelper $currencyExchangeHelper,
        MoneyTransferManager $moneyTransferManager
    ): JsonResponse {
        $buyer = User::firstOrFail();
        $seller = User::latest('id')->firstOrFail();

        try {
            $rate = $btcPriceProvider->getPriceInUsd();
            $usdAmount = (float) $request->amount;
            $satoshiAmount = $currencyExchangeHelper->usdToSatoshi($usdAmount, $rate);
            $moneyTransferManager->transferSatoshi($seller, $buyer, $satoshiAmount);
        } catch (\Throwable $exception) {
            response()->json([
                'status' => 'failed',
                'error' => $exception->getMessage(),
            ]);
        }

        $trade = new Trade();
        $trade->amount = $satoshiAmount;
        $trade->rate = $rate;
        $trade->status = TradeStatusEnum::PAID();
        $trade->payment_method_name = PaymentMethodEnum::WEBMONEY();
        $trade->buyer_id = $buyer->id;
        $trade->seller_id = $seller->id;
        $trade->save();

        return TradeResource::make($trade)->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
