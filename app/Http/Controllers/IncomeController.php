<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Shows all instances a user gained income
        $income = auth()->user()->income;
        return response()->json(['income' =>$income]);
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
        //
        $request->validate([
            'source' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);
        try {
            //code...

            $income = Income::create($request->except('id')+[
               'user_id'=>auth()->user()->id
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message'=>'failed',
                'error' => $th->getMessage()
            ]);
        }


        return response()->json(['message'=> 'successful',
        'income' => $income]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
        return $income;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'source' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);

        try {
            $income = Income::find($id);
        $income->update($request->except('id'));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message'=>'failed',
                'error' => $th->getMessage()
            ]);
        }

        return response()->json(['message'=> 'successful',
        'income' => $income]);
    }

    public function income7days(){
        $startdate = date('Y-m-d', strtotime('-6 days'));
        $enddate = date('Y-m-d');
        $id = auth()->user()->id;
        try {
            $income = Income::where('user_id',$id)->whereBetween('date',[$startdate,$enddate])->select('date','amount')->orderBy('date')->get();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'error' => $th->getMessage()
            ]);
        }

        return response()->json([
            'message' => 'successful',
            'income' => $income
        ]);
    }


    public function incomeMonth(){
        $startdate = date('Y-m-d', strtotime('-6 days'));
        $enddate = date('Y-m-d');
        $id = auth()->user()->id;
        try {
            $income = Income::where('user_id',$id)->whereMonth('date',Carbon::now()->month)->select('date','amount')->orderBy('date')->get();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'error' => $th->getMessage()
            ]);
        }

        return response()->json([
            'message' => 'successful',
            'income' => $income
        ]);
    }

    public function incomeWeek(){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $id = auth()->user()->id;
        try {
            $income = Income::where('user_id',$id)->whereBetween('date',[Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()])->select('date','amount')->orderBy('date')->get();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'error' => $th->getMessage()
            ]);
        }

        return response()->json([
            'message' => 'successful',
            'income' => $income
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
        try {
            //code...
            $income->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message'=>'failed',
                'error'=> $th->getMessage()
            ]);
        }

        return response()->json([
            'message'=>'successful'
        ]);
    }
}

