<?php
declare(strict_types=1);

use App\controllers\PageController;

return [
    '/' => [PageController::class, 'about'],
    '/requirements' => [PageController::class, 'requirements'],
    '/hardware' => [PageController::class, 'hardware'],
    '/installation' => [PageController::class, 'installation'],
    '/verification' => [PageController::class, 'verification'],
    '/configuration' => [PageController::class, 'configuration'],
    '/additional' => [PageController::class, 'additional'],
];
