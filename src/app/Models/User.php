<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string name
 * @property int reputation
 */
class User extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'reputation',
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(Trade::class, 'buyer_id');
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }
}
