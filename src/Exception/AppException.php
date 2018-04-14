<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @var int
     */
    private $httpErrorCode;

    public function __construct(
        string $internalErrorCode,
        string $httpErrorCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        string $message = ''
    ) {
        $this->internalErrorCode = $internalErrorCode;
        $this->httpErrorCode = $httpErrorCode;

        parent::__construct($message);
    }

    public function getInternalErrorCode(): string
    {
        return $this->internalErrorCode;
    }

    public function getHttpErrorCode(): int
    {
        return $this->httpErrorCode;
    }
}
