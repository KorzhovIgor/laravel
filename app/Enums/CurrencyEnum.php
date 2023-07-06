<?php

namespace App\Enums;

use App\Traits\EnumNames;
use App\Traits\EnumValues;

enum CurrencyEnum: string
{
    use EnumValues, EnumNames;

    case DOLLARS = 'dollars';
}
