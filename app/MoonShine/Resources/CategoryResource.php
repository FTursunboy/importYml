<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use MoonShine\Fields\Text;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Handlers\ImportHandler;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class CategoryResource extends ModelResource
{
    protected string $model = Category::class;

    protected string $title = 'Categories';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('название', 'title')
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function getActiveActions(): array
    {
        return [];
    }
    public function import(): ?ImportHandler
    {
        return null;
    }

    public function export(): ?ExportHandler
    {
        return null;
    }
}
