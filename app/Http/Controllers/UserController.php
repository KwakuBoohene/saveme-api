<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Route to get authenticated user

        if(auth()->user()){
            return response()->json([
                'username' => auth()->user()->username
            ]);
        }
        else{
            return response()->json([
                'error' => "No user has been logged in"
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
        $user = User::create($request->except('password')
        +['password'=>Hash::make($request->password)]);

        return response()->json([
            'message' => 'user created',
            'user' => $user['username']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function authenticate(Request $request){
        if($request['email'] && $request['password']){
            $credentials = $request->only(['email','password']);
            $token = auth()->attempt($credentials);
            if(!$token){
                return response()->json(['error' =>'invalid credentials']);
            }
            return true;
        }
        return response()->json(['error' =>'invalid credentials']);

    }

    public function login(Request $request){
        $authenticate = $this->authenticate($request);
        if($authenticate){
            $credentials = $request->only(['email','password']);
            $user = User::where('email',$credentials['email'])->first();
            $token = auth()->login($user);
            return response()->json([
                "token" => $token,
                "message" => $user->username.' logged in successfully'
                ]);
        }
    }

    public function logout(){
        auth()->logout();
    }
}
