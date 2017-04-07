<?php

namespace Kodo\Api\Foundation;

class Resource
{
	/**
	 * Holds the core element of the Api.
	 * @var \Kodo\Foundation\Core
	 */
	private $core;

	/**	
	 * Holds a list of resouces for a single api core.
	 * @var array
	 */
	protected $resources = [];

	/**	
	 * Builds the Resource
	 * @param \Kodo\Foundation\Core $core
	 */
	public function __construct(Core $core)
	{
		$this->core = $core;
	}

	/**
	 * Fetches a specefik key from the config array
	 * and supports key dot notation
	 * @param  string $key
	 * @return mixed
	 */
	protected function config($key = null)
	{
		return $this->core->config($key);
	}

	/**
	 * Sends a request thought guzzle
	 * @param  string $method
	 * @param  string|null $path
	 * @param  array  $body
	 * @return mixed
	 */
	protected function request($method, $path = null, $body = [])
	{
		return $this->core->request($method, $path, $body);
	}

	/**
	 * Fetches the pager of the core element.
	 * @return \Kodo\Foundation\Pager
	 */
	public function pager()
	{
		return $this->core->pager();
	}

	/**
	 * Allows access to resoureces
	 * @param  string $attribute
	 * @return mixed
	 */
   	public function __get($attribute)
    {
        if (array_key_exists($attribute, $this->resources)) {
            return new $this->resources[$attribute]($this->core);
        }

        trigger_error("Undefined property: ".static::class."::$".$attribute, E_USER_ERROR);
    }
}