<?php

namespace App\Http\API;

use Illuminate\Support\Facades\Http;

class PolandNBAPI
{
    public static function getCourse(string $currencyCode, ?string $date): ?string {
        return Http::withUrlParameters([
            'endpoint' => 'http://api.nbp.pl/api/exchangerates/rates/',
            'table' => 'A',
            'code' => $currencyCode,
            'date' => $date,
        ])->get('{+endpoint}/{table}/{code}/{date}')->json('rates.0.mid');
    }

}
