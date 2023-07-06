<?php

namespace App\Traits;

trait EnumNames
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }
}
