<?php

namespace Ruth\Api\Tests\Economic;

use PHPUnit\Framework\TestCase;

class EconomicConnectionTest extends TestCase
{
    public function test_can_connect_to_economic()
    {
        $client = new \Ruth\Api\Economic\Economic([
            'AppSecretToken' => 'demo',
            'AgreementGrantToken' => 'demo',
        ]);

        $this->assertNotNull($client->info());
    }
}
