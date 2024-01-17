<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Good;
use App\Services\Contracts\ImportDbInterface;
use Illuminate\Support\Facades\Http;

use Maatwebsite\Excel\Excel;

class ImportToDb implements ImportDbInterface
{

    public function import() :bool
    {
        $response = Http::timeout(60)->get(config('constants.xml_url'));
        if (!$response->successful()) {
            return false;
        }
        $xml = simplexml_load_string($response->body());

        $goods = [];
        $categories = [];

        foreach ($xml->shop->offers->offer as $offer) {

            $categoryId = (int)$offer->categoryId;

            $categoryElement = $xml->shop->categories->xpath("//category[@id='$categoryId']")[0];

            $categories[] = [
                'id' => $categoryId,
                'title' => (string)$categoryElement,
                'parent_id' => (int)$categoryElement['parentId'] ?? null,
            ];


            $goods[] =[
                'good_import_id' => $offer->attributes()['id'],
                'name' => $offer->name,
                'available' => (bool)$offer->attributes()['available'],
                'price' => $offer->price,
                'old_price' => $offer->oldprice,
                'currencyId' => $offer->currencyId,
                'url' => $offer->url,
                'category_id' => $offer->categoryId,
                'picture' => $offer->picture,
                'vendor' => $offer->vendor
            ];
        }

        $this->insertData($categories, $goods);

        return true;
    }

    private function insertData($categories, $goods)
    {
        Category::query()->upsert($categories, 'id');

        $chunkSize = 500;
        foreach (array_chunk($goods, $chunkSize) as $chunk) {
            Good::query()->upsert($chunk, 'good_import_id');
        }
    }
}
