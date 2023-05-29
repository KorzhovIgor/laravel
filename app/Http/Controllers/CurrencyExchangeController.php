<?php

namespace App\Http\Controllers;

use App\Http\API\PolandNBAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use stdClass;

class CurrencyExchangeController extends Controller
{
    public function getCurrencyCourses(Request $request)
    {
        $date = $request->query('date');
        $EUR = PolandNBAPI::getCourse('EUR', $date);
        if ($EUR !== null) {
            $procentPLNDInEUR = 1 / $EUR;
        }

        $USD = PolandNBAPI::getCourse('USD', $date);
        if ($USD !== null) {
            $procentPLNDInUSD = 1 / $USD;
        }

        return view('currencyCourses', ['euro' => $procentPLNDInEUR ?? null, 'usd' => $procentPLNDInUSD ?? null, 'day' => $date]);
    }
}
