<?php

namespace Ruth\Api\Economic;

use Ruth\Api\Foundation\Core;

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
        'invoice' => \Ruth\Api\Economic\Invoice::class,
        'product' => \Ruth\Api\Economic\Product::class,
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


    /**
     * Used to fetch the pagination elements of the result
     * @param  mixed $data
     * @return array
     */
    public function pagination($data)
    {
        return [
            'nextPage' => $data->pagination->nextPage ?? null,
            'prevPage' => $data->pagination->prevPage ?? null,
        ];
    }

    /**
     * Its used to modify the result data from the request
     * @param  mixed $data
     * @return mixed
     */
    protected function wrap($data)
    {
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
