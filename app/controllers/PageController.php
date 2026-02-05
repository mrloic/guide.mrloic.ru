<?php
declare(strict_types=1);

namespace App\controllers;

use Twig\Environment;

final class PageController
{
    private function baseData(string $active): array
    {
        return [
            'site_name' => 'Halcyonic',
            'active' => $active,
            'nav' => [
                ['title' => 'Home', 'href' => '/'],
                ['title' => 'Left Sidebar', 'href' => '/left-sidebar'],
                ['title' => 'Right Sidebar', 'href' => '/right-sidebar'],
                ['title' => 'No Sidebar', 'href' => '/no-sidebar'],
            ],
        ];
    }

    public function leftSidebar(Environment $twig): void
    {
        echo $twig->render('pages/left-sidebar.twig', $this->baseData('/left-sidebar'));
    }

    public function rightSidebar(Environment $twig): void
    {
        echo $twig->render('pages/right-sidebar.twig', $this->baseData('/right-sidebar'));
    }

    public function noSidebar(Environment $twig): void
    {
        echo $twig->render('pages/no-sidebar.twig', $this->baseData('/no-sidebar'));
    }
}
