<?php
declare(strict_types=1);

/**
 * @OA\Schema(
 *     schema="TradeCollection",
 *     title="TradeCollection",
 *     description="Collection of trades",
 *     @OA\Xml(
 *         name="TradeCollection"
 *     ),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         title="Data",
 *         description="Data wrapper",
 *         @OA\Items(ref="#/components/schemas/Trade")
 *     )
 * ),
 * @OA\Schema(
 *     schema="Trade",
 *     title="Trade",
 *     description="Trade model",
 *     @OA\Xml(
 *         name="Trade"
 *     ),
 *     @OA\Property(
 *         property="id",
 *         title="ID",
 *         type="integer",
 *         description="ID",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="amount",
 *         title="Amount",
 *         type="string",
 *         description="Trade amount in USD",
 *         example="332589.97"
 *     ),
 *     @OA\Property(
 *         property="rate",
 *         title="Rate",
 *         type="string",
 *         description="BTC price in USD",
 *         example="382589.97"
 *     ),
 *     @OA\Property(
 *         property="payment_method",
 *         title="Payment method",
 *         type="string",
 *         description="Payment method name",
 *         example="PayPal"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         title="Status",
 *         type="string",
 *         description="Trade status",
 *         enum={"Paid", "Not Paid"}
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         title="Created at",
 *         type="string",
 *         description="Created at datetime",
 *         example="2021-02-08T13:52:56.000000Z",
 *         format="datetime"
 *     ),
 *     @OA\Property(
 *         property="updated_id",
 *         title="Updated at",
 *         type="string",
 *         description="Updated at datetime",
 *         example="2021-02-08T13:52:56.000000Z",
 *         format="datetime"
 *     ),
 *     @OA\Property(
 *         property="buyer",
 *         title="Buyer",
 *         description="Buyer",
 *         ref="#/components/schemas/User"
 *     ),
 *     @OA\Property(
 *         property="seller",
 *         title="Seller",
 *         description="Seller",
 *         ref="#/components/schemas/User"
 *     )
 * ),
 * @OA\Schema(
 *     schema="User",
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     ),
 *     @OA\Property(
 *         property="id",
 *         title="ID",
 *         description="ID",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         title="Name",
 *         description="Name of the user",
 *         example="Mr. John Doe"
 *     ),
 *     @OA\Property(
 *         property="reputation",
 *         title="Reputation",
 *         description="User`s reputation",
 *         example=-1
 *     )
 * ),
 * @OA\Schema(
 *     schema="StoreTradeRequest",
 *     title="Store Trade request",
 *     description="Store Trade request body data",
 *     type="object",
 *     required={"amount"},
 *     @OA\Property(
 *         property="amount",
 *         type="string",
 *         title="Amount",
 *         description="rade amount in USD",
 *         example="332589.97"
 *     )
 * )
 */
