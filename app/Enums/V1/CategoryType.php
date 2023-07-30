<?php

namespace App\Enums\V1;

use App\Http\Traits\EnumRetriever;

enum CategoryType: string
{
    use EnumRetriever;

    case INCOME = 'income';
    case EXPENSE = 'expense';
}
