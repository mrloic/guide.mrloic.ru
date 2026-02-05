<?php
// var_dump($_SERVER['REQUEST_URI']); exit;

declare(strict_types=1);

$twig = require __DIR__ . '/../app/bootstrap.php';
$routes = require __DIR__ . '/../app/routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Вырезаем базовый путь (если сайт в подпапке)
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/'), '/');
if ($basePath && $basePath !== '/') {
    if (str_starts_with($uri, $basePath)) {
        $uri = substr($uri, strlen($basePath)) ?: '/';
    }
}

// Убираем trailing slash (кроме корня)
if ($uri !== '/' && str_ends_with($uri, '/')) {
    $uri = rtrim($uri, '/');
}

if (!isset($routes[$uri])) {
    http_response_code(404);
    echo $twig->render('pages/no-sidebar.twig', [
        'site_name' => 'Halcyonic',
        'active' => '',
        'nav' => [],
        'title' => '404',
        'message' => 'Page not found',
    ]);
    exit;
}

[$class, $method] = $routes[$uri];

$controller = new $class();
$controller->$method($twig);
