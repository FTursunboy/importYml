<?php

namespace App\Http\Controllers;

use App\Exports\YmlExport;

use App\Models\Category;
use App\Models\Good;
use App\Services\Contracts\ImportDbInterface;
use Illuminate\Support\Facades\Http;

class ImportToDb
{
    public function __invoke(ImportDbInterface $service)
    {
        $result = $service->import();
        if (!$result){
            return redirect()->with('error', 'error');
        }

        return redirect()->back();
    }

}
