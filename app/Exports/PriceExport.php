<?php

namespace App\Exports;

use App\Models\Price;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class PriceExport implements FromCollection
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return Price::all();
    }
}
