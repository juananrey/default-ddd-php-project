<?php

namespace App\Domain\Exception;

/**
 * Global exception within our system, which will ALWAYS have a well-defined error code
 * Such error code is defined in one of the files under ErrorCode/, which will be in this folder
 */
class AppException extends \Exception
{
    /**
     * @var string
     */
    private $internalErrorCode;

    public function __construct(string $internalErrorCode, string $message = '')
    {
        $this->internalErrorCode = $internalErrorCode;
        parent::__construct($message);
    }

    public function internalErrorCode(): string
    {
        return $this->internalErrorCode;
    }
}
