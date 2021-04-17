<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Saving;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        return response()->json([
            'message'=>'successful',
            'expenses'=> $expenses
            ]);
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
            'category'=>'required',
            'expenseFrom'=>'required'
        ]);

        try{
            $expense = Expense::create($request->except('id')+[
                'user_id' => auth()->user()->id
            ]);
            if ((strtolower($request->category) == 'saving')
             or (strtolower ($request->category)=='investment')
             or (strtolower ($request->category)=='investments')
             or (strtolower ($request->category)=='savings') ) {
               $saving = Saving::create([
                   'description' => $request->description,
                   'amount' => $request->amount,
                   'date' => $request->date,
                   'user_id' => auth()->user()->id,
                   'category' => $request->category
               ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => 'failed',
                'error' => $e
            ]);
        }

        return response()->json([
            'message'=> 'successful',
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
    public function update(Request $request)
    {
        //updates a user expense
        $request->validate([
            'description' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);
        try{
        $expense = Expense::find($request->id);
        $expense->update($request->except('id'));
        }catch(\Exception $e){
            return response()->json([
                'message' => ' failed'
            ]);
        }


        return response()->json([
            'message' => 'successful',
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
        try {
            $expense->delete();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e
            ]);
        }
        return response()->json([
            'message' => 'successful'
        ]);


    }

    public function expenses7days(){
        $startdate = date('Y-m-d', strtotime('-7 days'));
        $enddate = date('Y-m-d');
        $id = auth()->user()->id;
        try {
            $expense = Expense::where('user_id',$id)->whereBetween('date',[$startdate,$enddate])->select('date','amount')->orderBy('date')->get();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'error' => $th->getMessage()
            ]);
        }

        return response()->json([
            'message' => 'successful',
            'expenses' => $expense
        ]);
    }

    public function expensesFromSavings(){
        $id = auth()->user()->id;
        try {
            $expense = Expense::where('user_id',$id)->where('expenseFrom',true)->sum('amount');
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'error' => $th->getMessage()
            ]);
        }

        return response()->json([
            'message' => 'successful',
            'expenses' => $expense
        ]);
    }

    public function expensesFromIncome(){
        $id = auth()->user()->id;
        try {
            $expense = Expense::where('user_id',$id)->where('expenseFrom',false)->sum('amount');
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'error' => $th->getMessage()
            ]);
        }

        return response()->json([
            'message' => 'successful',
            'expenses' => $expense
        ]);
    }

}
