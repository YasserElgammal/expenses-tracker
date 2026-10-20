<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HasPagination
{
    protected function perPage(?Request $request = null): int
    {
        $request ??= request();

        $default = (int) config('constants.items_per_page', 15);

        return min(
            100,
            max(1, (int) ($request->input('items_per_page') ?: $default))
        );
    }
}
