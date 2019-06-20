<?php

namespace TecStore\Http\Controllers;
use TecStore\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'nom_usuario'     => 'required|string',
            'correo'    => 'required|string|email|unique:users',
            'password' => 'required|string',
        ]);
        $user = new User([
            'nom_usuario' => $request->nom_usuario,
            'correo' => $request->correo,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'num_cel' => $request->num_cel,
            'facebook' => "",
            'avatar' => "",
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return Response(['response'=>'¡Usuario registrado correctamente!']);
    }
    public function login(Request $request)
    {
        $request->validate([
            'nom_usuario'       => 'required|string',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);
        $credentials = request(['nom_usuario', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 
            'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
