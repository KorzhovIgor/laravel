<?php

namespace App\Http\Controllers\Export;

use App\Exports\ImagesExport;
use App\Exports\PriceExport;
use App\Exports\ProductExport;
use App\Exports\ProductServiceExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

class DBExportController extends Controller
{
    public function fileExport(): BinaryFileResponse
    {
        $products = Excel::download(new ProductExport, 'products.csv');
        $prices = Excel::download(new PriceExport, 'products.csv');
        $products_services = Excel::download(new ProductServiceExport, 'products.csv');
        $images = Excel::download(new ImagesExport, 'image.csv');

        $zip = new ZipArchive();
        $fileName = 'zipFile.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE)) {
            $zip->addFile($products);
            $zip->addFile($prices);
            $zip->addFile($products_services);
            $zip->addFile($images);
            $zip->close();
        }

        return response()->download(public_path($fileName));
    }
}
