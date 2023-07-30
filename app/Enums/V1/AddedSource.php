<?php

namespace App\Enums\V1;

use App\Http\Traits\EnumRetriever;

enum AddedSource: string
{
    use EnumRetriever;

    case API = 'api';
    case WEB = 'web';
}
