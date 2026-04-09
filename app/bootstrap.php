<?php
declare(strict_types=1);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

$projectRoot  = dirname(__DIR__);
$templatesDir = $projectRoot . '/templates';
$cacheDir     = $projectRoot . '/var/cache/twig';

if (!is_dir($cacheDir) && !@mkdir($cacheDir, 0777, true) && !is_dir($cacheDir)) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', $cacheDir));
}


$loader = new FilesystemLoader($templatesDir);

$twig = new Environment($loader, [
    'cache' => false,
    // 'cache' => $cacheDir,      // в разработке можно false
    'auto_reload' => true,
]);

// Если сайт не в корне домена, basePath будет вида "/something"
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
define('BASE_PATH', $basePath);

$twig->addFunction(new TwigFunction('asset', function (string $path): string {
    if (preg_match('#^https?://#', $path)) {
        return $path;
    }
    return BASE_PATH . '/' . ltrim($path, '/');
}));

$twig->addFunction(new TwigFunction('url', function (string $path = ''): string {
    if (preg_match('#^https?://#', $path)) {
        return $path;
    }
    return BASE_PATH . '/' . ltrim($path, '/');
}));

return $twig;
