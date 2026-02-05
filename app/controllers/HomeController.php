<?php
declare(strict_types=1);

namespace App\controllers;

use Twig\Environment;

final class HomeController
{
    public function index(Environment $twig): void
    {
        echo $twig->render('pages/index.twig', [
            'site_name' => 'Halcyonic',
            'active' => '/',
            'nav' => [
                ['title' => 'Home', 'href' => '/'],
                ['title' => 'Left Sidebar', 'href' => '/left-sidebar'],
                ['title' => 'Right Sidebar', 'href' => '/right-sidebar'],
                ['title' => 'No Sidebar', 'href' => '/no-sidebar'],
            ],
        ]);
    }
}
