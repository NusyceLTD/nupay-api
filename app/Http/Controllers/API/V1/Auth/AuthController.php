<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\BaseController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

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
        return $this->sendResponse([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ], "");
    }

    public function forgot()
    {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return $this->sendResponse([], 'Reset password link sent on your email id.');
    }

    public function reset()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return response()->json(["msg" => "Password has been successfully changed"]);
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

    /**
     * Get the authenticated User
     *
     * @param Request $request
     * @return JsonResponse [json] user object
     */

    public function details(Request $request)
    {
        $user =$request->user()->toArray();
        $user['roles'] = $request->user()->roles()->allRelatedIds();
        return $this->sendResponse($user, "All details of the authenticated User");
    }

    public function update(Request $request, User $user)
    {
        dd($user);
    }

    public function destroy()
    {

    }

    public function logout()
    {

    }

    public function index()
    {
        return $this->sendResponse(User::all()->toArray(), 'All users');
    }

    public function single(User $user)
    {
        return $this->sendResponse($user->toArray(), '');
    }

    public function find()
    {
        $users = array();
        $userCollections = User::all();
        foreach ($userCollections as $userColl) {
            $userCollArr = $userColl->toArray();
            $userCollArr['roles'] = $userColl->roles()->allRelatedIds();
            array_push($users, $userCollArr);
        }
        return $this->sendResponse($users, 'All users');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'is_company' => 'required',
            'email' => 'required|email'
        ]);
        $data = $request->all();
        $user = User::create($data);
        var_dump($user);
    }


    public function setting(Request $request)
    {

    }


}
