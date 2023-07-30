<?php

namespace App\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonhtlyStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'month_year' => $this->month_year,
            'month_income_total' => number_format($this->month_income_total, 2),
            'month_expense_total' => number_format($this->month_expense_total, 2),
            'month_saving_total' => number_format(max($this->month_income_total + $this->month_expense_total, 0), 2),
        ];
    }
}
