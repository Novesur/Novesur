<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{

    public function create(Request $request)
    {
        $cUsuario = $request->cUsuario;
        $cContraseña = $request->cContraseña;

        $rpta = Auth::attempt(['username' => $cUsuario, 'password' => $cContraseña]);


       // if ($rpta && $token = JWTAuth::attempt(['username' => $cUsuario, 'password' => $cContraseña])) {

            if ($rpta) {
            return response()->json(
                [
                    'AutUser' => Auth::user(),
                    'code' => 200,
                ],
            );
            //return $this->respondWithToken($token);
        } else {
            return response()->json([
                'code' => 401
            ]
        );
        }

    }
    public function logout()
    {

        Auth::logout();
        return response()->json([
            'code' => 204
        ]);
    }


/*     public function me()
    {
        return response()->json(JWTAuth::user());
    }

    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    } */
}
