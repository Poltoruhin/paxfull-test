<?php

namespace App\Exceptions;

class BtcUsdRateRequestException extends \Exception
{
    protected $message = 'Error occurred while getting BTC/USD rate.';
}
