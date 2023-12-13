<?php

namespace App\Helper\Exception;

use Throwable;
use UploadedFileException;

class InvalidTypeUploadedFileException extends UploadedFileException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}