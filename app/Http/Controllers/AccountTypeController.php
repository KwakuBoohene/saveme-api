<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $accountType = auth()->user()->accountTypes;
        $otherAccountTypes = AccountType::where('createdby',null)->get();
        try {
            $accountType  = $accountType->merge($otherAccountTypes);
            return response()->json([
                'message'=>'successful',
                'account_types'=> $accountType
                ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'failed',
                'error'=> $th
                ]);

        }


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
            'title' => 'required',
        ]);

        try{
            $accountType = AccountType::create($request->all()+[
                'createdby' => auth()->user()->id
            ]);
        }catch(\Throwable $e){
            return response()->json([
                'message' => 'failed',
                'error' => $e
            ]);
        }

        return response()->json([
            'message'=> 'successful',
            'expense' => $accountType]);
        // return Expense::create($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function show(AccountType $accountType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountType $accountType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountType $accountType)
    {
        //
        $request->validate([
            'title'=>'required',
        ]);
        try {
            $accountType->update($request->except('id'));
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'failed',
                'error' => $th
            ]);
        }
        return response()->json([
            'message' => 'successful',
            'expense' => $accountType
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountType $accountType)
    {
        //
        try {
            $accountType->delete();

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e
            ]);
        }
        return response()->json([
            'message' => 'successful',
            'description' => 'Account Type Deleted'
        ]);
    }
}
