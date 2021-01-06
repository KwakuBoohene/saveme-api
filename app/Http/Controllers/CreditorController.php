<?php

namespace App\Http\Controllers;

use App\Models\Creditor;
use Illuminate\Http\Request;

class CreditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //

        $creditor = auth()->user()->creditor();
        return response()->json($creditor);
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
        'payment_deadline' => 'required',
        'paid' => 'required',
        'user_id' => 'required',
        ]);
        $creditor = Creditor::create($request->all());
        return response()->json(['message'=> 'creditor instance created',
        'creditor' => $creditor]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function show(Creditor $creditor)
    {
        //
        return $creditor;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function edit(Creditor $creditor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
        'name' => 'required',
        'amount' => 'required',
        'date' => 'required',
        'payment_deadline' => 'required',
        'paid' => 'required',
        'user_id' => 'required',
        ]);
        $creditor = Creditor::find($id);
        $creditor->update($request->all());
        return response()->json(['message'=> 'creditor instance updated',
        'creditor' => $creditor]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creditor $creditor)
    {
        //
        $creditor->delete();
        return response()->json([
            'message'=>'creditor  deleted'
        ]);
    }
}
