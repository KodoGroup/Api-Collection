<?php

namespace Kodo\Economic;

use Kodo\Foundation\Core;

class Economic extends Core
{
	protected $resources = [
		'invoices' => \Kodo\Economic\Invoices::class,
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
		$this->setResultMeta([
			'nextPage' => $data->pagination->nextPage ?? null,
			'prevPage' => $data->pagination->prevPage ?? null,
		]);

		return $data->collection;
	}

	public function info()
	{
		return $this->request('GET', '/');
	}
}