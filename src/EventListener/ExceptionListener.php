<?php

namespace App\EventListener;

use App\Exception\AppException;
use App\Exception\ErrorCode\GlobalErrorCodes;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * This listener receives ALL errors within the application and will always return the errors in a JSON format
 */
class ExceptionListener
{
    /**
     * @var string
     */
    private $environment;

    public function __construct(string $environment)
    {
        $this->environment = $environment;
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();
        $response = new JsonResponse();

        if ($exception instanceof AppException) {
            $response->setStatusCode($exception->getHttpErrorCode());
        } elseif ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if (false === $this->isProductionEnvironment()) {
            $response->setJson(json_encode($this->buildErrorMessage($exception)));
        } else {
            $response->setJson(json_encode($this->buildErrorMessageForProductionClient($exception)));
            // Here, use your application of preference to write ALL error logs (e.g. rollbar)
        }

        $event->setResponse($response);
    }

    private function buildErrorMessage(\Exception $exception): array
    {
        $errorMessage = [];
        if ($exception instanceof AppException) {
            $errorMessage['errorCode'] = $exception->getInternalErrorCode();
        } else {
            $errorMessage['errorCode'] = GlobalErrorCodes::INTERNAL_SERVER_DRAMA;
        }

        $errorMessage['errorMessage'] = $exception->getMessage();
        $errorMessage['errorStackTrace'] = $exception->getTrace();

        return $errorMessage;
    }

    private function buildErrorMessageForProductionClient(\Exception $exception): array
    {
        $errorMessage = $this->buildErrorMessage($exception);
        unset($errorMessage['errorStackTrace']);

        return $errorMessage;
    }

    private function isProductionEnvironment(): bool
    {
        return in_array($this->environment, ['pre', 'pro']);
    }
}
