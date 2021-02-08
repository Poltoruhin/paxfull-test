<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Store Trade request",
 *      description="Store Trade request body data",
 *      type="object",
 *      required={"amount"}
 * )
 */
class StoreTradeRequest
{
    /**
     * @OA\Property(
     *     title="Amount",
     *     description="Trade amount in USD",
     *     example="332589.97"
     * )
     *
     * @var string
     */
    private $amount;
}
