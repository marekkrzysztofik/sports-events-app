<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Coach;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $input = [
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id'),
            'type' => $request->input('type'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ];

        if ($request->filled('user_id')) {
            $coach = Coach::create($input);
            $success['token'] = $coach->createToken('MyApp')->plainTextToken;
            $success['name'] = $coach->name;
            $success['id'] = $coach->user_id;
            $success['type'] = $coach->type;
            $response = [
                'success' => true,
                'data' => $success,
                'message' => "User registered successfully"
            ];
        } else {
            $user = User::create($input);
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['id'] = $user->id;
            $success['name'] = $user->name;
            $success['type'] = $user->type;
            $response = [
                'success' => true,
                'data' => $success,
                'message' => "User registered successfully"
            ];
        }
        return response()->json($response, 200);
    }
    public function handleLogin(Request $request)
    {
        if ($request['type'] == 'Admin') {
            return $this->adminLogin($request);
        } else {
            return $this->coachLogin($request);
        }
    }
    public function adminLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['id'] = $user->id;
            $success['name'] = $user->name;
            $success['type'] = $user->type;
            $response = [
                'success' => true,
                'data' => $success,
                'message' => "User logged successfully"
            ];
            return response()->json($response, 200);
        }
        return response()->json(['success' => false, 'message' => 'Invalid email or password'], 401);
    }
    public function coachLogin(Request $request)
    {
        if (Auth::guard('coach')->attempt($request->only('email', 'password'))) {
            $user = Auth::guard('coach')->user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['id'] = $user->user_id;
            $success['name'] = $user->name;
            $success['type'] = $user->type;
            $response = [
                'success' => true,
                'data' => $success,
                'message' => "User logged successfully"
            ];
            return response()->json($response, 200);
        }
        return response()->json(['success' => false, 'message' => 'Invalid email or password'], 401);
    }
    public function getUsers()
    {
        return User::all();
    }
    public function getCoaches()
    {
        return Coach::all();
    }
}
