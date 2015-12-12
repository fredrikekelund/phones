<?php

/**
 * Calculate the lowest price for a phone number based on a list of phone number
 * prefixes and prices.
 */
class PriceCalculator
{
	public $priceLists;
	public $defaultResponse = [
		'operator' => '',
		'prefix' => '',
		'price' => null
	];

	function __construct(&$priceLists)
	{
		$this->priceLists = &$priceLists;
	}

	/**
	 * Loops over the predefined list of operators and their price lists and
	 * retreives the best price for the provided phone number. It should be said
	 * that this method makes no assumptions about whether the lists are sorted
	 * or not. In a real world scenario, we would probably load the lists from a
	 * database, and we could then store the prefixes as integers and ask the
	 * database to sort the price list for us as we request the lists. If we
	 * sorted the lists by prefix in descending order, we would be able to more
	 * quickly exit the loop that determines what the best matching prefix for
	 * an operator is. But sorting the lists in the application before we loop
	 * over them to find the best matching prefix would take more time than to
	 * simply loop over them once in an unordered format.
	 * @param  [String] $phoneNumber
	 * @return [Array]
	 */
	public function getLowestPrice($phoneNumber)
	{
		$operatorPrices = array_map(function($operator) use ($phoneNumber) {
			$cheapest = array_reduce($operator['entries'], function($result, $entry) use ($phoneNumber) {
				$prefixMatches = strpos($phoneNumber, $entry['prefix']) === 0;
				$prefixIsLonger = strlen($entry['prefix']) > strlen($result['prefix']);

				return $prefixMatches && $prefixIsLonger ? $entry : $result;
			}, ['prefix' => '']);

			return [
				'operator' => $operator['name'],
				'price' => array_key_exists('price', $cheapest) ? $cheapest['price'] : null,
				'prefix' => array_key_exists('prefix', $cheapest) ? $cheapest['prefix'] : null
			];
		}, $this->priceLists);

		return array_reduce($operatorPrices, function($result, $operator) {
			$resultHasPrice = is_numeric($result['price']);
			$operatorHasPrice = is_numeric($operator['price']);
			$operatorIsCheapest = $operator['price'] < $result['price'];

			return ((!$resultHasPrice && $operatorHasPrice) || ($operatorHasPrice && $operatorIsCheapest)) ? $operator : $result;
		}, $this->defaultResponse);
	}
}
