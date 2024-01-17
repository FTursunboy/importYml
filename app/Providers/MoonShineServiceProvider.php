<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\CategoriesResource;
use App\MoonShine\Resources\GoodResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuItem;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [
           // MenuItem::make('Категории', new CategoriesResource()),
            MenuItem::make('Товары', new GoodResource()),
        ];
    }

    /**
     * @return array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
