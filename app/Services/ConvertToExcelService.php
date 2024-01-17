<?php

namespace App\Services;

use App\Services\Contracts\ImportExcelInterface;
use Illuminate\Support\Facades\Http;

use Maatwebsite\Excel\Excel;

class ConvertToExcelService implements ImportExcelInterface
{

    public function import() :array|null
    {
        $response = Http::timeout(60)->get(config('constants.xml_url'));
        if (!$response->successful()) {
            return null;
        }
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

        return [
            'offers' => $offers,
            'categories' => $categories
        ];
    }
}
