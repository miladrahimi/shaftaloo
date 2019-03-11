<?php

namespace App\Exceptions;

class ApiErrorException extends \Exception
{
    /**
     * ApiErrorException constructor.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = "", int $code = 400)
    {
        parent::__construct($message, $code, null);
    }
}
