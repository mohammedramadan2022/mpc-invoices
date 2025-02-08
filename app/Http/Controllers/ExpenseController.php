<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Repositories\ExpenseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExpenseController extends AppBaseController
{
    /** @var ExpenseRepository */
    public $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepo)
    {
        $this->expenseRepository = $expenseRepo;
    }

    public function index(Request $request)
    {
        return view('expense.index');
    }

    public function store(CreateExpenseRequest $request): JsonResponse
    {
        $input = $request->all();
        $expense = $this->expenseRepository->store($input);

        return $this->sendResponse($expense, __('messages.flash.expense_saved_successfully'));
    }

    public function edit(Expense $expense): JsonResponse
    {
        return $this->sendResponse($expense,  __('messages.flash.expense_retrieved_successfully'));
    }

    public function update(UpdateExpenseRequest$request, $expenseId): JsonResponse
    {
        $input = $request->all();
        $this->expenseRepository->update($input, $expenseId);

        return $this->sendSuccess(__('messages.flash.expense_updated_successfully'));
    }

    public function destroy(Expense $expense): JsonResponse
    {


        $expense->delete();

        return $this->sendSuccess(__('messages.flash.expense_deleted_successfully'));
    }
}
