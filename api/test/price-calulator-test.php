<?php
require 'price-calculator.php';

class PriceCalculatorTest extends PHPUnit_Framework_TestCase
{
	public $priceLists = [
		[
			'name' => 'Telia',
			'entries' => [
				['prefix' => '48', 'price' => 0.5],
				['prefix' => '21', 'price' => 0.9],
				['prefix' => '211', 'price' => 0.92],
				['prefix' => '1', 'price' => 0.95],
				['prefix' => '467', 'price' => 3],
				['prefix' => '4673', 'price' => 0.44],
				['prefix' => '045', 'price' => 0.1],
				['prefix' => '88', 'price' => 5],
				['prefix' => '49', 'price' => 1.25]
			]
		],
		[
			'name' => 'Tele2',
			'entries' => [
				['prefix' => '48', 'price' => 0.4],
				['prefix' => '211', 'price' => 1.265],
				['prefix' => '33', 'price' => 4],
				['prefix' => '99', 'price' => 0.9],
				['prefix' => '467', 'price' => 2.99],
				['prefix' => '045', 'price' => 0.5]
			]
		]
	];

	public function testGetLowestPrice()
	{
		$priceCalculator = new PriceCalculator($this->priceLists);

		$results = [
			// Test that the cheapest number wins
			$priceCalculator->getLowestPrice('21171334'),
			// Test that the longest prefix wins
			$priceCalculator->getLowestPrice('467352080'),
			// Test that a prefix only present in one list returns a result
			$priceCalculator->getLowestPrice('3372982'),
			$priceCalculator->getLowestPrice('497205731'),
			// Test that there's a match even when only the prefix is supplied
			$priceCalculator->getLowestPrice('1'),
			// Test the default, empty response
			$priceCalculator->getLowestPrice('humdum')
		];

		$this->assertEquals(0.92, $results[0]['price']);

		$this->assertEquals(0.44, $results[1]['price']);
		$this->assertEquals('4673', $results[1]['prefix']);

		$this->assertEquals(4, $results[2]['price']);
		$this->assertEquals('Tele2', $results[2]['operator']);

		$this->assertEquals(1.25, $results[3]['price']);
		$this->assertEquals(0.95, $results[4]['price']);

		$this->assertEquals($priceCalculator->defaultResponse, $results[5]);
		$this->assertNull($results[5]['price']);
	}
}
