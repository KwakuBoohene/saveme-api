<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Debtor;
use App\Models\Creditor;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $summary = auth()->user()->summary;
        return response()->json($summary);
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
    public function store()
    {
        //
        $id = auth()->user()->id;
        $income = Income::where('user_id',$id)->sum('amount');
        $expense = Expense::where('user_id',$id)->sum('amount');
        $net_income = $income - $expense;
        $debtors = Debtor::where('user_id',$id)->sum('amount');
        $creditors = Creditor::where('user_id',$id)->sum('amount');
        $net_debt  = $creditors - $debtors;
        $summary = Summary::create([
            'user_id' => $id,
            'net_income' => $net_income,
            'net_debt' => $net_debt
        ]);

        return response()->json(['message'=> 'summary instance created',
        'summary' => $summary]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function show(Summary $summary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function edit(Summary $summary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id = auth()->user()->id;
        $income = Income::where('user_id',$id)->sum('amount');
        $expense = Expense::where('user_id',$id)->sum('amount');
        $net_income = $income - $expense;
        $debtors = Debtor::where('user_id',$id)->sum('amount');
        $creditors = Creditor::where('user_id',$id)->sum('amount');
        $net_debt  = $debtors - $creditors;
        $summary = Summary::where('user_id',$id)->first();
        $summary->update([
            'user_id' => $id,
            'net_income' => $net_income,
            'net_debt' => $net_debt
            ]);

        return response()->json(['message'=> 'summary instance updated',
        'summary' => $summary]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Summary $summary)
    {
        //
        $summary->delete();
        return response()->json([
            'message'=>'summary  deleted'
        ]);
    }
}
