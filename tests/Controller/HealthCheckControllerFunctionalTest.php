<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group functional
 */
class HealthCheckControllerFunctionalTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    /**
     * @covers App\EventListener\ExceptionListener::onKernelException
     */
    public function testRandomUrl_shoulReturnAJsonFormatted404Error()
    {
        $this->client->request('GET', '/randomUrl');
        $this->assertResponseIsInJsonFormat();

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());

        $response = $this->getJsonResponseParsedAsArray($this->client->getResponse());

        $this->assertArrayHasKey('errorCode', $response);
        $this->assertArrayHasKey('errorMessage', $response);

        $this->assertSame('GLOB0001', $response['errorCode']);
        $this->assertSame('No route found for "GET /randomUrl"', $response['errorMessage']);
    }

    /**
     * @covers App\Controller\HealthCheckController::healthCheck
     */
    public function testHealthCheck_success()
    {
        $this->client->request('GET', '/_healthcheck');
        $this->assertResponseIsInJsonFormat();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(['status' => 'i am ok'], $this->getJsonResponseParsedAsArray($this->client->getResponse()));
    }

    private function assertResponseIsInJsonFormat()
    {
        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }

    private function getJsonResponseParsedAsArray(Response $response): array
    {
        return json_decode($response->getContent(), true);
    }
}