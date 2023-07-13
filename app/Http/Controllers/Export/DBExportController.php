<?php

namespace App\Http\Controllers\Export;

use App\Exports\ImagesExport;
use App\Exports\PriceExport;
use App\Exports\ProductExport;
use App\Exports\ProductServiceExport;
use App\Http\Controllers\Controller;
use App\Mail\ExportPrice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

class DBExportController extends Controller
{
    public function fileExportToS3(): RedirectResponse
    {
        Excel::store(new ProductExport, 'products.csv', 's3');
        Excel::store(new PriceExport, 'price.csv', 's3');
        Excel::store(new ProductServiceExport, 'product_service.csv', 's3');
        Excel::store(new ImagesExport, 'image.csv', 's3');
        Mail::to('darggerrfs@gmail.com')->send(new ExportPrice());


        return redirect()->back();
    }
}
