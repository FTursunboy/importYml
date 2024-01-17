<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class YmlExport implements WithMultipleSheets
{
    protected $offers;
    protected $categories;

    public function __construct($offers, $categories)
    {
        $this->offers = $offers;
        $this->categories = $categories;
    }

    public function sheets(): array
    {
        $sheets = [
            'offers' => new GoodExport($this->offers),
            'categories' => new CategoriesExport($this->categories),
        ];

        return $sheets;
    }
}
