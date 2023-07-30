<?php

namespace App\Http\Controllers\V1\Api;

use App\DataTransferObjects\V1\Transaction\TransactionDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\TransactionRequest;
use App\Http\Resources\V1\Api\MonhtlyStatisticsResource;
use App\Http\Resources\V1\Api\TransactionResource;
use App\Models\V1\Transaction;
use App\Services\V1\Transaction\TransactionService;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $service
    ) {
    }

    public function index(Request $request)
    {
        $transactions = $this->service->index($request);

        return $this->successReponse(data: TransactionResource::collection($transactions));
    }

    public function store(TransactionRequest $request)
    {
        $this->service->store(TransactionDto::comingRequestFromApi($request));

        return $this->successReponse(message: trans('app.record_added'));
    }

    public function show($id)
    {
        $transaction = $this->service->show($id);

        return $this->successReponse(data: TransactionResource::make($transaction));
    }

    public function update($id, TransactionRequest $request)
    {
        $this->service->update($id, TransactionDto::comingRequestFromApi($request));

        return $this->successReponse(message: trans('app.record_updated'));
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return $this->successReponse(message: trans('app.record_deleted'));
    }

    public function statistics(Request $request)
    {
        $transactions = $this->service->statistics($request);

        return $this->successReponse(data: MonhtlyStatisticsResource::collection($transactions));
    }
}
