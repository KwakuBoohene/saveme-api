<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use Illuminate\Http\Request;

class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $debtor = auth()->user()->debtor();
        return response()->json($debtor);
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
            'name' => 'required',
        'amount' => 'required',
        'date' => 'required',
        'payment_date' => 'required',
        'paid' => 'required',
        'user_id' => 'required',
        ]);
        $debtor = Debtor::create($request->all());
        return response()->json(['message'=> 'debtor instance created',
        'debtor' => $debtor]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function show(Debtor $debtor)
    {
        //
        return $debtor;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function edit(Debtor $debtor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'payment_date' => 'required',
            'paid' => 'required',
            'user_id' => 'required',
            ]);
            $debtor = Debtor::find($id);
            $debtor->update($request->all());
            return response()->json(['message'=> 'debtor instance updated',
            'debtor' => $debtor]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Debtor  $debtor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debtor $debtor)
    {
        //
        $debtor->delete();
        return response()->json([
            'message'=>'debtor  deleted'
        ]);
    }
}
