<?php
// var_dump($_SERVER['REQUEST_URI']); exit;

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$twig = require __DIR__ . '/../app/bootstrap.php';
$routes = require __DIR__ . '/../app/routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Вырезаем базовый путь (если сайт в подпапке)
if (defined('BASE_PATH') && BASE_PATH !== '') {
	if (str_starts_with($uri, BASE_PATH)) {
		$uri = substr($uri, strlen(BASE_PATH)) ?: '/';
	}
}

// Убираем trailing slash (кроме корня)
if ($uri !== '/' && str_ends_with($uri, '/')) {
	$uri = rtrim($uri, '/');
}

if (!isset($routes[$uri])) {
	http_response_code(404);
	echo $twig->render('pages/error.twig', [
		'site_name' => '',
		'active' => '',
		'nav' => [['title' => 'Главная страница', 'href' => '/']],
		'title' => '404',
		'message' => 'Страница не найдена',
	]);
	exit;
}

try {
	$handler = $routes[$uri];

	if ($handler instanceof \Closure) {
		$handler($twig);
	} else {
		[$class, $method] = $handler;
		$controller = new $class();
		$controller->$method($twig);
	}
} catch (\Throwable $e) {
	http_response_code(500);
	echo $twig->render('pages/error.twig', [
		'site_name' => '',
		'active' => '',
		'nav' => [['title' => 'Главная страница', 'href' => '/']],
		'title' => '500',
		'message' => 'Внутренняя ошибка сервера',
	]);
	// Optionally: error_log((string)$e);
}
