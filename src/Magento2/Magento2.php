<?php

namespace Ruth\Api\Magento2;

use Ruth\Api\Foundation\Core;

/**
 * @link http://devdocs.magento.com/swagger/index_21.html
 */
class Magento2 extends Core
{
    protected $token = null;

    /**
     * Returns the url of the request
     * @param  string $endpoint
     * @return string
     */
    protected function url($endpoint = null)
    {
        return rtrim($this->config('url'), '/').'/rest/V1/'.trim($endpoint, '/');
    }

    /**
     * Defines the headers of a request
     * @return array
     */
    protected function headers()
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$this->token}",
        ];
    }

    public function logon()
    {
        $this->token = json_decode($this->request('POST', 'integration/admin/token', [
            'json' => [
                'username' => $this->config('username'),
                'password' => $this->config('password'),
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]));
    }
}
