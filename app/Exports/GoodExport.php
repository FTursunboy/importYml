<?php

namespace App\Exports;

use App\Models\Good;
use Maatwebsite\Excel\Concerns\FromCollection;

class GoodExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Good::all();
    }
}
