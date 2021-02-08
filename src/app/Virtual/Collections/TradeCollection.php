<?php

namespace App\Virtual\Collections;

use App\Virtual\Models\Trade;

/**
 * @OA\Schema(
 *     title="TradeCollection",
 *     description="Collection of trades",
 *     @OA\Xml(
 *         name="TradeCollection"
 *     )
 * )
 */
class TradeCollection
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var Trade[]
     */
    private $data;
}
