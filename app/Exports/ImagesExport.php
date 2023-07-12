<?php

namespace App\Exports;

use App\Models\Image;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ImagesExport implements FromCollection
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return Image::all();
    }
}
