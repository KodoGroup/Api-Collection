<?php

namespace Kodo\Tests\Economic;

use PHPUnit\Framework\TestCase;

class EconomicConnectionTest extends TestCase
{
	public function test_can_connect_to_economic()
	{
		$client = new \Kodo\Economic\Economic([
			'AppSecretToken' => 'demo',
			'AgreementGrantToken' => 'demo',
		]);

		$this->assertNotNull($client->info());
	}
}