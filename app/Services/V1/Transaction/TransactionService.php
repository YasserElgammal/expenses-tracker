<?php

namespace App\Services\V1\Transaction;

use App\DataTransferObjects\V1\Transaction\TransactionDto;
use App\Models\V1\Transaction;
use App\Traits\HasPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    use HasPagination;

    public function store(TransactionDto $transactionDto)
    {
        return Transaction::create([
            'amount' => $transactionDto->amount,
            'description' => $transactionDto->description,
            'date' => $transactionDto->date,
            'category_id' => $transactionDto->category_id,
            'user_id' => $transactionDto->user_id,
            'added_source' => $transactionDto->added_source,
        ]);
    }

    public function index(Request $request)
    {
        return Transaction::with('user', 'category')->where('user_id', auth()->id())->latest('date')
            ->paginate($this->perPage($request));
    }

    public function show($id)
    {
        return Transaction::with('user')->where('user_id', auth()->id())->findOrFail($id);
    }

    public function update($id, TransactionDto $transactionDto)
    {
        $transaction = Transaction::where('user_id', auth()->id())->findOrfail($id);

        return $transaction->update([
            'amount' => $transactionDto->amount,
            'description' => $transactionDto->description,
            'category_id' => $transactionDto->category_id,
            'date' => $transactionDto->date,
            'user_id' => $transactionDto->user_id,
            'added_source' => $transactionDto->added_source,
        ]);
    }

    public function destroy($id)
    {
        $transaction = Transaction::where('user_id', auth()->id())->findOrfail($id);

        return $transaction->delete($id);
    }

    public function statistics(Request $request)
    {
        return DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', auth()->id())
            ->when($request->filled('month'), function ($query) use ($request) {
                $query->whereMonth('transactions.date', $request->integer('month'));
            })
            ->when($request->filled('year'), function ($query) use ($request) {
                $query->whereYear('transactions.date', $request->integer('year'));
            })
            ->select(
                DB::raw('DATE_FORMAT(transactions.date, "%M - %Y") as month_year'),
                DB::raw('SUM(CASE WHEN categories.type = "income" THEN transactions.amount ELSE 0 END) as month_income_total'),
                DB::raw('SUM(CASE WHEN categories.type = "expense" THEN transactions.amount ELSE 0 END) as month_expense_total')
            )->groupBy('month_year')->orderByRaw('MAX(transactions.date) DESC')
            ->paginate($this->perPage($request));
    }
}
