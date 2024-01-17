<?php

namespace App\Exports;

use App\Models\Good;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{

    protected $categories;

    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    public function collection()
    {
        return $this->categories;
    }
    /**
     * @return \Illuminate\Support\Collection
     */


    public function headings(): array
    {
        return [
            'Id',
            'Name'
        ];
    }
}

