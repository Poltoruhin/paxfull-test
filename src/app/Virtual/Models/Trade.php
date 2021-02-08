<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Trade",
 *     description="Trade model",
 *     @OA\Xml(
 *         name="Trade"
 *     )
 * )
 */
class Trade
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

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

    /**
     * @OA\Property(
     *     title="Rate",
     *     description="BTC price in USD",
     *     example="382589.97"
     * )
     *
     * @var string
     */
    private $rate;

    /**
     * @OA\Property(
     *     title="Payment method",
     *     description="Payment method name",
     *     example="PayPal"
     * )
     *
     * @var string
     */
    private $payment_method;

    /**
     * @OA\Property(
     *     title="Status",
     *     description="Trade status",
     *     enum={"Paid", "Not Paid"}
     * )
     *
     * @var string
     */
    private $status;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2021-02-08T13:52:56.000000Z",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2021-02-08T13:52:56.000000Z",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_id;

    /**
     * @OA\Property(
     *     title="Buyer",
     *     description="Buyer"
     * )
     *
     * @var User
     */
    private $buyer;

    /**
     * @OA\Property(
     *     title="Seller",
     *     description="Seller"
     * )
     *
     * @var User
     */
    private $seller;
}
