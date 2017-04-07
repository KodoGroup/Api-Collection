<?php

namespace Kodo\Api\Economic;

use Kodo\Api\Foundation\Resource;

class ProductPrice extends Resource
{
	/**
	 * Fetches specefik prices for a product.
	 * @link https://restdocs.e-conomic.com/#get-products-productnumber-pricing-currency-specific-sales-prices
	 * @param  integer $productId
	 * @param  array  $query
	 * @return mixed
	 */
	public function get($productId, $query = [])
	{
		return $this->request('GET', "products/{$productId}/pricing/currency-specific-sales-prices", $query);
	}

	/**	
	 * Fetches a specefik price for a product.
	 * @link https://restdocs.e-conomic.com/#get-products-productnumber-pricing-currency-specific-sales-prices-currencycode
	 * @param  integer $productId
	 * @param  string $currencyCode
	 * @return mixed
	 */
	public function find($productId, $currencyCode)
	{
		return $this->request('GET', "products/{$productId}/pricing/currency-specific-sales-prices/{$currencyCode}");
	}

	/**	
	 * Creates a new sales price for a product.
	 * @link https://restdocs.e-conomic.com/#post-products-productnumber-pricing-currency-specific-sales-prices
	 * @param  integer $productId
	 * @param  object $price
	 * @return mixed
	 */
	public function create($productId, $price)
	{
		return $this->request('POST', "products/{$productId}/pricing/currency-specific-sales-prices", $price);
	}

	/**	
	 * Updates a sales price.
	 * @link https://restdocs.e-conomic.com/#put-products-productnumber-pricing-currency-specific-sales-prices-currencycode
	 * @param  integer $productId
	 * @param  string $currencyCode
	 * @param  object $price
	 * @return mixed
	 */
	public function update($productId, $currencyCode, $price)
	{
		return $this->request('PUT', "products/{$productId}/pricing/currency-specific-sales-prices/{$currencyCode}", $price);
	}

	/**	
	 * Deletes a sales price for a product.
	 * @link https://restdocs.e-conomic.com/#delete-products-productnumber-pricing-currency-specific-sales-prices-currencycode
	 * @param  integer $productId
	 * @param  string $currencyCode
	 * @return mixed
	 */
	public function delete($productId, $currencyCode)
	{
		return $this->request('DELETE', "products/{$productId}/pricing/currency-specific-sales-prices/{$currencyCode}");
	}
}