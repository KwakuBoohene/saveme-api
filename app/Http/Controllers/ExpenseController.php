<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //Shows user expenses by user

        $expenses = auth()->user()->expenses;
        return response()->json($expenses);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //stores a user expense
        $request->validate([
            'description' => 'required',
            'amount' => 'required',
            'date' => 'required',

        ]);
        $expense = Expense::create($request->all()+[
            'user_id' => auth()->user()->id
        ]);
        return response()->json(['message'=> 'expense created',
        'expense' => $expense]);
        // return Expense::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
        return $expense;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //updates a user expense
        $request->validate([
            'description' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);
        $expense = Expense::find($id);
        $expense->update($request->all());

        return response()->json([
            'message' => 'expense updated!',
            'expense' => $expense
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //deletes a user expense

        $expense->delete();
        return response()->json([
            'message' => 'expense deleted'
        ]);
    }
}
