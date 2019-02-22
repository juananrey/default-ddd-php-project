<?php

namespace App\Test\Infrastructure\Ui\Web\Symfony\Controller;

use App\Infrastructure\Ui\Web\Symfony\Controller\HealthCheckController;
use PHPUnit\Framework\TestCase;

class HealthCheckControllerUnitTest extends TestCase
{
    /**
     * @var HealthCheckController
     */
    private $healthCheckController;

    function setUp()
    {
        parent::setUp();
        $this->healthCheckController = new HealthCheckController();
    }

    public function testHealthCheckReturnsWhatWeExpect()
    {
        $response = $this->healthCheckController->healthCheck();
        $expected = json_encode(['status' => 'i am ok']);
        $this->assertEquals($expected, $response->getContent());
    }
}