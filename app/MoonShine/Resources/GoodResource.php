<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Good;

use MoonShine\ActionButtons\ActionButton;
use MoonShine\Fields\File;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Preview;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;

use MoonShine\Handlers\ExportHandler;
use MoonShine\Handlers\ImportHandler;
use MoonShine\Pages\Pages;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;


class GoodResource extends ModelResource
{
    protected string $model = Good::class;

    protected string $title = 'Goods';

    public function actions(): array
    {
        return [
            ActionButton::make('Загрузить товары в экзель', route('excel'))->primary(),
            ActionButton::make('Загрузить товары в базу', route('mysql'))->success()
        ];
    }

    public function getActiveActions(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [

            Block::make([
                ID::make()->sortable(),
                Text::make('название', 'name'),
                Number::make('цена', 'price'),
                Preview::make('В наличии', 'available')->boolean(),
                BelongsTo::make('категория', 'category', 'title')->sortable()
            ]),
        ];
    }

    public function components(): array
    {

        return [
            ActionButton::make(
                label: 'Buttewon title',
                url: route('excel'),
            )
        ];
    }

    public function import(): ?ImportHandler
    {
        return null;
    }

    public function export(): ?ExportHandler
    {
        return null;
    }


    public function routes(): void
    {
        // TODO: Implement routes() method.
    }


    public function rules(Model $item): array
    {
        // TODO: Implement rules() method.
    }
}
