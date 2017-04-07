<?php

namespace Kodo\Api\Economic;

use Kodo\Api\Foundation\Core;

/*
 * @link(Documentation, https://restdocs.e-conomic.com/)
 */
class Economic extends Core
{
	/**	
	 * Holds a list of resouces for a single api core.
	 * @var array
	 */
	protected $resources = [
		'invoice' => \Kodo\Economic\Invoice::class,
		'product' => \Kodo\Economic\Product::class,
	];

	/**
     * Returns the url of the request
     * @param  string $endpoint
     * @return string
     */
	protected function url($endpoint = null)
	{
		return 'https://restapi.e-conomic.com/'.trim($endpoint, '/');
	}

	/**
	 * Defines the headers of a request
	 * @return array
	 */
	protected function headers()
	{
		return [
			'X-AppSecretToken'      => $this->config('AppSecretToken'),
			'X-AgreementGrantToken' => $this->config('AgreementGrantToken'),
			'Content-Type'          => 'application/json',
		];
	}

	protected function wrap($data)
	{
		$this->pager([
			'nextPage' => $data->pagination->nextPage ?? null,
			'prevPage' => $data->pagination->prevPage ?? null,
		]);

		if (isset($data->collection)) {
			return $data->collection;
		}

		return $data;
	}

	public function info()
	{
		return $this->request('GET', '/');
	}
}