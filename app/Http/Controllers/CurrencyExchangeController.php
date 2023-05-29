<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use stdClass;

class CurrencyExchangeController extends Controller
{
    public function getCurrencyCourses(Request $request)
    {
        $date = $request->query('date');
        $EUR = Http::withUrlParameters([
            'endpoint' => 'http://api.nbp.pl/api/exchangerates/rates/',
            'table' => 'A',
            'code' => 'EUR',
            'date' => $date,
        ])->get('{+endpoint}/{table}/{code}/{date}')->json('rates.0.mid');

        if ($EUR !== null) {
            $procentPLNDInEUR = 1 / $EUR;
        }

        $USD = Http::withUrlParameters([
            'endpoint' => 'http://api.nbp.pl/api/exchangerates/rates/',
            'table' => 'A',
            'code' => 'USD',
            'date' => $date,
        ])->get('{+endpoint}/{table}/{code}/{date}')->json('rates.0.mid');

        if ($USD !== null) {
            $procentPLNDInUSD = 1 / $USD;
        }

        return view('currencyCourses', ['euro' => $procentPLNDInEUR ?? null, 'usd' => $procentPLNDInUSD ?? null, 'day' => $date]);
    }
}
