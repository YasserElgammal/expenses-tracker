<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;

trait EnumRetriever
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
