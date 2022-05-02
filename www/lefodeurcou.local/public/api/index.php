<?php

	require_once __DIR__ . '/vendor/autoload.php';
	require_once __DIR__ . '/endpoints/sendMail.php';

	use Crazy\Router;

	define('API_ROUTE', '/api');

	$router = new Crazy\Router();

	$router->addRoute(Crazy\Router::GET, API_ROUTE, function () {
		header('Content-Type: application/json');
		echo json_encode(
			[
				'version'	=> 1,
				'endpoints'	=> [
					'public' => [
						'/v1/send/mail'
					]
				]
			]
		);
	});

	$router->addRoute(Crazy\Router::POST, API_ROUTE . '/v1/send/mail', 'sendMail');

	$router->run();
?>