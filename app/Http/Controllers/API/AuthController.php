<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json([
            'users' => $user
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function messages(){
        return array(
            'email.required'=>'You cant leave Email field empty',
            'password.required'=>'You cant leave Name field empty',
            'password.min'=>'Password lenght must be greater than 8 letters',
            'name.required'=>'Please enter a name to get started',
            'email.unique'=>'Sorry email already exist',
            'email.email'=>'Enter a valid email',
        );
    }
    public function store(Request $request){
        $rules = array(
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'name' => 'required',
        );

        $validator = Validator::make($request->all(), $rules, $this->messages());

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ],422);
        }

        $user = new User();

        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;

        if($request->has('phone')){
            $user->phone = $request->phone;
        }
        
        if($request->has('address')){
            $user->address = $request->address;
        }

        if($request->has('description')){
            $user->description = $request->description;
        }

        $user->save();

        $token = $user->createToken($user->email)->plainTextToken;

        return response()->json([
            'message' => 'user created',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(Request $request){
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:8',
        );

        $validator = Validator::make($request->all(), $rules, $this->messages());

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ],422);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token = $user->createToken($user->email)->plainTextToken;
            return response()->json([
                'message' => 'Logged in',
                'token' => $token,
                'user' => $user,
            ], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'email' => 'nullable|email|unique:users,email,'. $id,
        );

        $validator = Validator::make($request->all(), $rules, $this->messages());

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ],422);
        }

        $user = User::findOrFail($id);

        if($request->has('phone')){
            $user->phone = $request->phone;
        }
        if($request->has('name')){
            $user->name = $request->name;
        }

        if($request->has('email')){
            $user->email = $request->email;
        }
        
        if($request->has('address')){
            $user->address = $request->address;
        }

        if($request->has('description')){
            $user->description = $request->description;
        }

        $user->save();

        return response()->json([
            'message' => 'user updated',
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->tokens()->delete();
        $user->delete();
        return response()->json([
            'message' => 'Deleted'
        ],200);
    }

    public function logout(Request $request){
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out'
        ],200);
    }
}
