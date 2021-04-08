<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $savings = auth()->user()->savings;
        return response()->json(['savings'=> $savings ]);
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
            'description' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'category'=>'required'
        ]);

        try{
            $saving = Saving::create($request->except('id')+[
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
            'saving' => $saving]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function show(Saving $saving)
    {
        //
        return $saving;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function edit(Saving $saving)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saving $saving)
    {
        //
        $request->validate([
            'description' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);
        try{
        $saving = Saving::find($request->id);
        $saving->update($request->except('id'));
        }catch(\Exception $e){
            return response()->json([
                'message' => ' failed',
                'error' => $e
            ]);
        }


        return response()->json([
            'message' => 'successful',
            'saving' => $saving
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saving  $saving
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saving $saving)
    {
        //
        try {
            $saving->delete();

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
