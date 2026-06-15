<?php

declare(strict_types=1);

use App\controllers\PageController;

$routes = [
	'/' => [PageController::class, 'about'],
	'/requirements' => [PageController::class, 'requirements'],
	'/hardware' => [PageController::class, 'hardware'],
	'/installation' => [PageController::class, 'installation'],
	'/verification' => [PageController::class, 'verification'],
	'/configuration' => [PageController::class, 'configuration'],
	'/additional' => [PageController::class, 'additional'],
	'/distributions' => [PageController::class, 'distributions'],
	'/company' => [PageController::class, 'company'],
	'/network-scheme' => [PageController::class, 'networkScheme'],
	'/company-saas' => [PageController::class, 'companySaaS'],
];

// Автоматическая генерация роутов только для файлов внутри папки work (без подпапок)
$workDir = realpath(__DIR__ . '/../templates/pages/work');
if ($workDir && is_dir($workDir)) {
	$iterator = new \DirectoryIterator($workDir);
	foreach ($iterator as $file) {
		if ($file->isFile() && $file->getExtension() === 'twig') {
			$filename = $file->getFilename();
			$routePath = '/work/' . preg_replace('/\.twig$/', '', $filename);
			$templatePath = 'pages/work/' . $filename;

			$routes[$routePath] = function (\Twig\Environment $twig) use ($templatePath, $routePath) {
				$controller = new PageController();
				$controller->renderDynamic($twig, $templatePath, $routePath);
			};
		}
	}
}

return $routes;
