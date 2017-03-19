<?php

namespace Kodo\Foundation;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

abstract class Core
{
	private $config;
	private $guzzle;
	protected $resources = [];

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
	 * Define the headers of a request
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
	 * Sends a request thought guzzle
	 * @param  string $method
	 * @param  string|null $path
	 * @param  array  $body
	 * @return mixed
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

		try {
			return json_decode($this->guzzle->request($method, $this->url($path), $options)->getBody()->getContents());
		} catch (ClientException $e) {
			return json_decode($e->getResponse()->getBody()->getContents());
		}
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