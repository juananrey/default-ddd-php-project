<?php

namespace App\Test\Controller;

use PHPUnit\Framework\TestCase;
use App\Controller\HealthCheckController;

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