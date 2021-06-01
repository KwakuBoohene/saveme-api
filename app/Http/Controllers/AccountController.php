<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $accounts = auth()->user()->accounts;
        return response()->json([
            'message'=>'successful',
            'accounts'=> $accounts
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
        //stores a user account
        $request->validate([
            'title' => 'required',
        ]);

        try{
            $account = Account::create($request->except('id')+[
                'user_id' => auth()->user()->id
            ]);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'failed',
                'error' => $e
            ]);
        }

        return response()->json([
            'message'=> 'successful',
            'account' => $account]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
        return $account;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //updates a user account
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
        ]);
        try{
        $account = Account::find($request->id);
        $account->update($request->except('id'));
        }catch(\Exception $e){
            return response()->json([
                'message' => ' failed'
            ]);
        }


        return response()->json([
            'message' => 'successful',
            'account' => $account
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
        try {
            $account->delete();

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
}
