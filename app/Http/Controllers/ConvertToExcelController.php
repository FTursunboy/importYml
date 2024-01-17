<?php

namespace App\Http\Controllers;

use App\Exports\GoodExport;
use App\Exports\YmlExport;
use App\Services\Contracts\ImportExcelInterface;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\NoReturn;
use Maatwebsite\Excel\Facades\Excel;

class ConvertToExcelController extends Controller
{
    public function __invoke(ImportExcelInterface $service)
    {
        $data = $service->import();
        if (!$data) {
            return redirect()->back()->with('error', 'error');
        }

        return Excel::download(new YmlExport($data['offers'], $data['categories']), 'goods-export.xlsx');
    }
}
