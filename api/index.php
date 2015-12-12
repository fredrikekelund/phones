<?php
require 'vendor/autoload.php';
require './price-calculator.php';

$app = new \Slim\Slim();
$app->add(new \SlimJson\Middleware(array(
	'json.status' => true
)));


$app->get('/', function() use ($app) {
	$body = ['Hello' => 'World'];

	$app->render(200, $body);
});

$operators = [
	[
		'name' => 'Operatör A',
		'entries' => [
			['prefix' => '1', 'price' => 0.9],
			['prefix' => '268', 'price' => 5.1],
			['prefix' => '46', 'price' => 0.17],
			['prefix' => '4620', 'price' => 0.0],
			['prefix' => '468', 'price' => 0.15],
			['prefix' => '4631', 'price' => 0.15],
			['prefix' => '4673', 'price' => 0.9],
			['prefix' => '46732', 'price' => 1.1]
		]
	],
	[
		'name' => 'Operatör B',
		'entries' => [
			['prefix' => '1', 'price' => 0.92],
			['prefix' => '44', 'price' => 0.5],
			['prefix' => '46', 'price' => 0.2],
			['prefix' => '467', 'price' => 1.0],
			['prefix' => '48', 'price' => 1.2]
		]
	]
];

$app->get('/price/:phoneNumber', function($phoneNumber) use ($app, $operators) {
	$calculator = new PriceCalculator($operators);
	$cheapest = $calculator->getLowestPrice($phoneNumber);

	if (isset($cheapest['price'])) {
		$app->render(200, $cheapest);
	} else {
		$app->render(404, ['error' => 'No results found']);
	}
});

$app->run();
