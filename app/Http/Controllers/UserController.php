<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;


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
                'user' => auth()->user()
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

        try {
            $user = User::create($request->except('password')
        +['password'=>Hash::make($request->password)]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'failed',
                'error' => $e
            ]);
        }
        return response()->json([
            'message' => 'successful',
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
                return false;
            }
            return true;
        }
        return response()->json(['error' =>'invalid credentials']);

    }

    public function login(Request $request){
            $credentials = $request->only(['email','password']);

            try {
                $user = User::where('email',$credentials['email'])->first();
                if(Hash::check($credentials['password'], $user['password'])){
                    $token = auth()->login($user);
                }else{
                    return response()->json([
                        'message' =>'Invalid',
                        'error' => 'Invalid Password'
                        ]);
                }
            } catch (\Throwable $t) {
                return response()->json([
                    'message' =>'Invalid',
                    'error' => $t->getMessage()
                    ]);
            }

            return response()->json([
                "token" => $token,
                "message" => 'successful'
                ]);
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message'=>'logged out successfully']);
    }
}
