<?php

namespace Ruth\Api\Foundation;

use GuzzleHttp\Exception\ClientException;

class ApiException extends \Exception
{
    private $body;

    public function __construct($message = null, $code = 0, \Exception $e = null)
    {
        if ($e instanceof ClientException) {
            $this->body = json_decode($e->getResponse()->getBody()->getContents());
        }

        parent::__construct($message, $code, $e);
    }

    /**
     * Fetches json response from the exception
     * @return object|array
     */
    public function getBody()
    {
        return $this->body;
    }
}
