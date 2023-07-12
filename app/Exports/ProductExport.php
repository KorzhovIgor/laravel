<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Database\Eloquent\Collection
     */
    public function collection(): Collection
    {
        return Product::all();
    }
}
