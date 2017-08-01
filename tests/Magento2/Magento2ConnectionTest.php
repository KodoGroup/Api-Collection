<?php

namespace Ruth\Api\Tests\Magento2;

use PHPUnit\Framework\TestCase;

class Magento2ConnectionTest extends TestCase
{
    public function test_can_connect_to_magento()
    {
        $client = new \Ruth\Api\Magento2\Magento2([
            'url'      => null,
            'username' => null,
            'password' => null,
        ]);

        var_dump($client);
    }
}
