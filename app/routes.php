<?php
declare(strict_types=1);

return [
    '/' => ['App\\controllers\\PageController', 'about'],
    '/requirements' => ['App\\controllers\\PageController', 'requirements'],
    '/hardware' => ['App\\controllers\\PageController', 'hardware'],
    '/installation' => ['App\\controllers\\PageController', 'installation'],
    '/verification' => ['App\\controllers\\PageController', 'verification'],
    '/configuration' => ['App\\controllers\\PageController', 'configuration'],
    '/additional' => ['App\\controllers\\PageController', 'additional'],
];
