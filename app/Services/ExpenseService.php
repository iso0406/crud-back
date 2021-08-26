<?php

namespace App\Services;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseRequest;
use Validator;


class ExpenseService {
    
    public function create(ExpenseRequest $request){
        $dataExpense = $request->all();
        $dataExpense['date_expense'] = date('Y-m-d', strtotime($dataExpense['date_expense']));
        $expenseRegistered = Expense::create($dataExpense);

        return $expenseRegistered;
    }

    public function getAll(){
        return Expense::with('user')->get();
    }

    public function findExpense($id){
        $expense = Expense::with('user')->findOrFail($id);
        return $expense;
    }

    /*public function searchByName($name){
        $expenditure = Expense::where('name','LIKE',"%{$name}%")->get();
        return $expenditure;
    }*/

    public function update(Request $request, $id){
        $dataExpense = $request->all();
        $dataExpense['date_expense'] = date('Y-m-d', strtotime($dataExpense['date_expense']));
        $expense = $this->findExpense($id);
        $expense->update($dataExpense);
        return $expense;
    }

    public function delete($id){
        $expense = $this->findExpense($id);
        $expense->delete();
        return $expense;
    }
}