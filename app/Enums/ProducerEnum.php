<?php

namespace App\Enums;

use App\Traits\EnumNames;
use App\Traits\EnumValues;

enum ProducerEnum: string
{
    use EnumValues, EnumNames;

    case SAMSUNG = 'samsung';
    case SONY = 'sony';
    case NOKIA = 'nokia';
}
