<?php

namespace Kodo\Api\Economic;

use Kodo\Api\Foundation\Resource;

class Product extends Resource
{
	/**	
	 * Holds a list of resouces for a single api core.
	 * @var array
	 */
	protected $resources = [];

	/**
	 * Fetches a list of products.
	 * @return mixed
	 */
	public function get()
	{
		return $this->request('GET', 'products');
	}

	/**	
	 * Finds a single product.
	 * @param  integer $id
	 * @return mixed
	 */
	public function find($id)
	{
		return $this->request('GET', "products/{$id}");
	}

	/**	
	 * Creates a new product.
	 * @param  array $data
	 * @return mixed
	 */
	public function create($data)
	{
		return $this->request('POST', 'products');
	}

	/**
	 * Updates an existing product.
	 * @param  integer $id
	 * @param  array  $data
	 * @return mixed
	 */
	public function update($id, $data)
	{
		return $this->request('PUT', "products/{$id}", $data);
	}

	/**
	 * Deletes a product.
	 * @param  integer $id
	 * @return mixed
	 */
	public function delete($id)
	{
		return $this->request('DELETE', "products/{$id}");
	}
}