<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductServiceExport implements FromCollection
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return DB::table('products_services')->get();
    }
}
