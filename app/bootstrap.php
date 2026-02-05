<?php
declare(strict_types=1);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

require __DIR__ . '/../vendor/autoload.php';

$projectRoot  = dirname(__DIR__);
$templatesDir = $projectRoot . '/templates';
$cacheDir     = $projectRoot . '/var/cache/twig';

if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0777, true);
}

$loader = new FilesystemLoader($templatesDir);

$twig = new Environment($loader, [
    'cache' => $cacheDir,      // в разработке можно false
    'auto_reload' => true,
]);

// Если сайт не в корне домена, basePath будет вида "/something"
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/'), '/');
if ($basePath === '') $basePath = '';

$twig->addFunction(new TwigFunction('asset', function (string $path) use ($basePath): string {
    return $basePath . '/' . ltrim($path, '/');
}));

$twig->addFunction(new TwigFunction('url', function (string $path = '') use ($basePath): string {
    return $basePath . '/' . ltrim($path, '/');
}));

return $twig;
