<?php

namespace App\Http\Controllers;

use App\Exports\GoodExport;
use App\Exports\YmlExport;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\NoReturn;
use Maatwebsite\Excel\Facades\Excel;

class ConvertToExcelController extends Controller
{
    public function __invoke()
    {
        $response = Http::timeout(60)->get('https://quarta-hunt.ru/bitrix/catalog_export/export_Ngq.xml');
        $xml = simplexml_load_string($response->body());

        $offers = collect();
        $categories = collect();

        foreach ($xml->shop->offers->offer as $offer) {

            $offers->push([
                'id' => $offer->attributes()['id'],
                'name' => $offer->name,
                'available' => $offer->attributes()['available'],
                'price' => $offer->price,
                'old_price' => $offer->oldprice,
                'currencyId' => $offer->currencyId,
                'url' => $offer->url,
                'categoryId' => $offer->categoryId,
                'picture' => $offer->picture,
                'vendor' => $offer->vendor
            ]);

            $categoryId = (int)$offer->categoryId;

            $categories->push([
                'id' => $categoryId,
                'name' => $xml->shop->categories->xpath("//category[@id='$categoryId']")[0],
            ]);

        }

        return Excel::download(new YmlExport($offers, $categories), 'goods-export.xlsx');
    }
}
