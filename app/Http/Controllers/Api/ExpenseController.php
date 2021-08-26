<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;
use App\Services\ExpenseService;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\ExpenseCollection;

class ExpenseController extends Controller {
    private $expenseService;

    public function __construct(ExpenseService $expenseService){
        $this->expenseService = $expenseService;
    }

    public function index() {
        $arr_expense = $this->expenseService->getAll();

        return response()->json(
            [
                'expenditure' => $arr_expense,
            ], 200
        );
    }

    public function store(ExpenseRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 400);
        }
        $expense = $this->expenseService->create($request);
        return response()->json(
            [
                'expense' => new ExpenseResource($expense),
                'message' => 'Despesa registrado com sucesso!'
            ], 200
        );
    }

    public function show($id) {
        $expense = $this->expenseService->findExpense($id);
        return response()->json(
            [
                'expense' => $expense,
                'message' => 'Despesa selecionado com sucesso!'
            ], 200
        );
    }

    /*
    public function searchByName($name) {
        $expense = $this->expenseService->searchByName($name);
        return response()->json(
            [
                'expense' => new RoofStructureCollection($expense),
                'message' => 'Despesa selecionado com sucesso!'
            ], 200
        );
    }*/

    public function update(Request $request, $id) {
        $expense = $this->expenseService->update($request, $id);
        return response()->json(
            [
                'expense' => $expense,
                'message' => 'Despesa atualizado com sucesso!'
            ], 200
        );
    }

    public function destroy($id) {
        $expense = $this->expenseService->delete($id);
        return response()->json(
            [
                'expense_deleted' => $expense,
                'message' => 'Despesa excluido com sucesso!'
            ], 200
        );
    }
}
