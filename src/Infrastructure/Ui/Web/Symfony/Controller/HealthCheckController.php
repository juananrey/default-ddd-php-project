<?php

namespace App\Infrastructure\Ui\Web\Symfony\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class HealthCheckController
{
    /**
     * @Route("/_healthcheck", methods={"GET"})
     */
    public function healthCheck(): JsonResponse
    {
        return new JsonResponse(['status' => 'i am ok']);
    }
}
