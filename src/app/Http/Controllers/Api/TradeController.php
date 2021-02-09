<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTradeRequest;
use App\Http\Resources\TradeResource;
use App\Models\Trade;
use App\Models\User;
use App\Services\BtcPriceProvider;
use App\Services\CurrencyExchangeHelper;
use App\Services\TradeManager;
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
     * )
     *
     * @return AnonymousResourceCollection
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
     *
     * @param Trade $trade
     * @return TradeResource
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
     *
     * @param StoreTradeRequest $request
     * @param BtcPriceProvider $btcPriceProvider
     * @param CurrencyExchangeHelper $currencyExchangeHelper
     * @param TradeManager $tradeManager
     * @return JsonResponse
     */
    public function store(
        StoreTradeRequest $request,
        BtcPriceProvider $btcPriceProvider,
        CurrencyExchangeHelper $currencyExchangeHelper,
        TradeManager $tradeManager
    ): JsonResponse {
        $buyer = User::firstOrFail();
        $seller = User::latest('id')->firstOrFail();

        try {
            $rate = $btcPriceProvider->getPriceInUsd();
            $usdAmount = (float) $request->amount;
            $satoshiAmount = $currencyExchangeHelper->usdToSatoshi($usdAmount, $rate);
            $trade = $tradeManager->trade($seller, $buyer, $satoshiAmount, $rate);
        } catch (\Throwable $exception) {
            return response()->json([
                'status' => 'failed',
                'error' => $exception->getMessage(),
            ]);
        }

        return TradeResource::make($trade)->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
