<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class HealthCheckController
{
    /**
     * @Route("/_healthcheck")
     * @Method({"GET"})
     */
    public function healthCheck(): JsonResponse
    {
        return new JsonResponse(['status' => 'i am ok']);
    }
}
