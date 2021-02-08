<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="USer"
 *     )
 * )
 */
class User
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
     *      title="Name",
     *      description="Name of the user",
     *      example="Mr. John Doe"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     title="Reputation",
     *     description="User`s reputation",
     *     example=-1
     * )
     *
     * @var integer
     */
    private $reputation;
}
