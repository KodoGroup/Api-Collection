<?php

namespace Kodo\Economic;

use Kodo\Foundation\Core;

/*
 * @link(Documentation, https://restdocs.e-conomic.com/)
 */
class Economic extends Core
{
	protected $resources = [
		'invoice' => \Kodo\Economic\Invoice::class,
		'product' => \Kodo\Economic\Product::class,
	];

	protected function url($endpoint = null)
	{
		return 'https://restapi.e-conomic.com/'.trim($endpoint, '/');
	}

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