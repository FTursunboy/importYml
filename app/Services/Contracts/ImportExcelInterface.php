<?php
namespace App\Services\Contracts;

interface ImportExcelInterface {
    public function import() :array|null;
}
