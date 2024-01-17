<?php

namespace App\Exports;

use App\Models\Good;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GoodExport implements FromCollection, WithHeadings
{

    protected $offers;

    public function __construct($offers)
    {
        $this->offers = $offers;
    }

    public function collection()
    {
        return $this->offers;
    }
    /**
     * @return \Illuminate\Support\Collection
     */


    public function headings(): array
    {
        return [
            'id',
            'name',
            'available',
            'price',
            'old_price',
            'currencyId',
            'url',
            'categoryId',
            'picture',
            'vendor'
        ];


    }
}

