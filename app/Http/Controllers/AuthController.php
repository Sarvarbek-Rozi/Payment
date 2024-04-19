<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api,user', ['except' => ['login']]);
        $this->response = [
            'success' => true,
            'result' => [],
            'error' => [] ,
        ];
    }
    /**
     * @SWG\Get(
     *     path="api/auth/login",
     *     summary="Login qilib kirish",
     *     tags={"Users"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function login()
    {

        $credentials = request(['phone', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $this->response['success'] = true;

        $this->response['result'] = $this->withToken($token);
        return response()->json($this->response);
    }
    protected function withToken($token)
    {
        $user = Auth::user();
        if($user->status==0) {
            return ('Error');
        }
            $user->update([
                    'login_last_date' => date('Y-m-d H:i:s'),
                    'jwt_token' => $token

                ]
            );

            return [
                'access_token' => $token,
                'user' => $user,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60
            ];
    }
    public function logout()
    {
        $guard = 'api';
        auth()->logout();
        Auth::guard($guard)->logout();
        return response()->json($this->response);
    }
}
