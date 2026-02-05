<?php
declare(strict_types=1);

return [
    '/' => ['App\\controllers\\HomeController', 'index'],
    '/left-sidebar' => ['App\\controllers\\PageController', 'leftSidebar'],
    '/right-sidebar' => ['App\\controllers\\PageController', 'rightSidebar'],
    '/no-sidebar' => ['App\\controllers\\PageController', 'noSidebar'],
];
