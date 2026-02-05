<?php
declare(strict_types=1);

namespace App\controllers;

use Twig\Environment;

final class PageController
{
    private function baseData(string $active): array
    {
        return [
            'site_name' => 'Отказоустойчивая архитектура для SaaS',
            'active' => $active,
            'nav' => [
                ['title' => 'О руководстве', 'href' => '/'],
                ['title' => 'Требования', 'href' => '/requirements'],
                ['title' => 'Обзор серверного оборудования', 'href' => '/hardware'],
                ['title' => 'Установка', 'href' => '/installation'],
                ['title' => 'Проверка', 'href' => '/verification'],
                ['title' => 'Настройка', 'href' => '/configuration'],
                ['title' => 'Дополнительно', 'href' => '/additional'],
            ],
        ];
    }

    public function about(Environment $twig): void
    {
        echo $twig->render('pages/index.twig', $this->baseData('/'));
    }

    public function requirements(Environment $twig): void
    {
        echo $twig->render('pages/requirements.twig', $this->baseData('/requirements'));
    }

    public function hardware(Environment $twig): void
    {
        echo $twig->render('pages/hardware.twig', $this->baseData('/hardware'));
    }

    public function installation(Environment $twig): void
    {
        echo $twig->render('pages/installation.twig', $this->baseData('/installation'));
    }

    public function verification(Environment $twig): void
    {
        echo $twig->render('pages/verification.twig', $this->baseData('/verification'));
    }

    public function configuration(Environment $twig): void
    {
        echo $twig->render('pages/configuration.twig', $this->baseData('/configuration'));
    }

    public function additional(Environment $twig): void
    {
        echo $twig->render('pages/additional.twig', $this->baseData('/additional'));
    }
}
