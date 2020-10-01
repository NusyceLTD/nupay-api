<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => 'false',
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = Auth::user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
        $success['token'] = $user->createToken('Nusyce')->accessToken;
        $success['token'] = $user->createToken('Nusyce')->accessToken;
        return $this->sendResponse($success, "");
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'is_company' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        $data = $request->all();
        $data['password'] = \Hash::make($request->password);
        $user = User::create($data);
        if ($user) {
            $success['name'] = $user->first_name;
            $success['token'] = $user->createToken('*')->accessToken;
            return $this->sendResponse($success);
        } else {
            return $this->sendError('Echec opération');
        }
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $success['token'] = $user->createToken('Nusyce', ['*'])->accessToken;
            return response()->json(['success' => $success], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function adminRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $success['name'] = $user->name;
        $success['token'] = $user->createToken('Nusyce', ['*'])->accessToken;
        return response()->json(['success' => $success], 200);
    }

}
