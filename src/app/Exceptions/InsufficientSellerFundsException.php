<?php

namespace App\Exceptions;

class InsufficientSellerFundsException extends \Exception
{
    protected $message = 'Insufficient seller funds.';
}
