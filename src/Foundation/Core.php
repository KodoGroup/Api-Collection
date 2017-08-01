<?php

namespace Ruth\Api\Foundation;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ruth\Api\Foundation\ApiException;
use Ruth\Api\Foundation\Pager;

abstract class Core
{
    /**
     * Configuration for the api.
     * @var array
     */
    protected $config;

    /**
     * Just Guzzle.
     * @var [type]
     */
    protected $guzzle;

    /**
     * The Page element for api pagination.
     * @var \Ruth\Foundation\Pager|null
     */
    protected $pager = null;

    /**
     * Holds a list of resouces for a single api core.
     * @var array
     */
    protected $resources = [];

    /**
     * Defines if the response should be formattet.
     * @var boolean
     */
    protected $rawResponse = false;

    /**
     * Builds the Client
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->guzzle = new Client;
    }

    /**
     * Fetches a specefik key from the config array
     * and supports key dot notation
     * @param  string $key
     * @return mixed
     */
    public function config($key)
    {
        $data = $this->config;

        if (is_null($key)) {
            return $data;
        }

        if (array_key_exists($key, $data)) {
            return $data[$key];
        }
        
        foreach (explode('.', $key) as $segment) {
            if (is_array($data) && array_key_exists($segment, $data)) {
                $data = $data[$segment];
            } else {
                return null;
            }
        }

        return $data;
    }

    /**
     * Defines the headers of a request
     * @return array
     */
    protected function headers()
    {
        return [];
    }

    /**
     * Returns the url of the request
     * @param  string $endpoint
     * @return string
     */
    abstract protected function url($endpoint = null);

    /**
     * Builds up the url for guzzle.
     * @param  string $path
     * @return string
     */
    private function buildUrl($path = null)
    {
        if (preg_match('/(https?:\/\/)/', $path)) {
            return $path;
        }

        return $this->url($path);
    }

    /**
     * Its used to modify the result data from the request
     * @param  mixed $data
     * @return mixed
     */
    protected function wrap($data)
    {
        return $data;
    }

    /**
     * Builds up the response.
     * @param  mixed $contents
     * @return \Illuminate\Support\Collection|object
     */
    private function buildResponse($contents, $raw = false)
    {
        $result = json_decode($contents);

        // Build pagination links.
        $this->pager(
            $this->pagination($result)
        );

        if ($this->rawResponse) {
            return $result;
        }

        // Modify result data.
        $result = $this->wrap($result);

        //
        if (is_array($result)) {
            return Collection::make($result);
        }

        return $result;
    }

    /**
     * Sends a request thought guzzle
     * @param  string $method
     * @param  string|null $path
     * @param  array  $body
     * @param  boolean $raw
     * @return \Illuminate\Support\Collection|object
     * @throws \Kodo\Foundation\ApiException
     */
    public function request($method, $path = null, $body = [])
    {
        $options = [
            'headers' => $this->headers(),
        ];

        switch ($method) {
            case 'GET':
                $options['query'] = $body;
                break;

            case 'POST':
            case 'PUT':
                $options['json'] = $body;
                break;
        }

        $url = $this->buildUrl($path);

        try {
            return $this->buildResponse(
                $this->guzzle->request($method, $url, $options)->getBody()->getContents()
            );
        } catch (ClientException $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Used to fetch the pagination elements of the result
     * @param  mixed $result
     * @return array
     */
    public function pagination($result)
    {
        return [];
    }

    /**
     * Builds up the pagination object and fetches it.
     * @param  array  $data
     * @return \Ruth\Foundation\Pager
     */
    public function pager($data = [])
    {
        if (count($data) > 0) {
            return $this->pager = new Pager($this, $data);
        }

        if (is_null($this->pager)) {
            $this->pager = new Pager($this);
        }

        return $this->pager;
    }

    /**
     * Allows access to resoureces
     * @param  string $attribute
     * @return mixed
     */
    public function __get($attribute)
    {
        if (array_key_exists($attribute, $this->resources)) {
            return new $this->resources[$attribute]($this);
        }

        trigger_error("Undefined property: ".static::class."::$".$attribute, E_USER_ERROR);
    }
}
