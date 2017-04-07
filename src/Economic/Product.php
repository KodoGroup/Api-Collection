<?php

namespace Kodo\Api\Economic;

use Kodo\Api\Foundation\Resource;

class Product extends Resource
{
	/**
	 * Fetches a list of products.
	 * @return \Illuminate\Support\Collection
	 */
	public function get()
	{
		return $this->request('GET', 'products');
	}

	/**	
	 * Finds a single product.
	 * @param  integer $id
	 * @return object
	 */
	public function find($id)
	{
		return $this->request('GET', "products/{$id}");
	}

	/**	
	 * Creates a new product.
	 * @param  array $data
	 * @return object
	 */
	public function create($data)
	{
		return $this->request('POST', 'products');
	}

	/**
	 * Updates an existing product.
	 * @param  integer $id
	 * @param  array  $data
	 * @return object
	 */
	public function update($id, $data)
	{
		return $this->request('PUT', "products/{$id}", $data);
	}

	/**
	 * Deletes a product.
	 * @param  integer $id
	 * @return object
	 */
	public function delete($id)
	{
		return $this->request('DELETE', "products/{$id}");
	}

	public function pricing($id)
	{
		return $this->request('GET', "products/{$id}/pricing/currency-specific-sales-prices");
	}
}