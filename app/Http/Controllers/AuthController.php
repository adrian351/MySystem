<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Armado;
use App\Models\Producto;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','pruebas', 'armados']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(){
        $user = new User(request()->all());
        $user -> password = bcrypt($user->password);
        $user->save();

        return response()->json(['data' =>$user], 200);
    }



    public function login()
    {
        $credentials = request(['email', 'password']); 

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = auth()->attempt($credentials);
        return $this->createNewToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {

         return auth()->user();
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function pruebas(){



        return response()->json([
            'code' => 200,
            'data'=>Producto::all()]);
     }

    public function armados(){
        return response()->json([
            'code' => 200,
            'data' => Armado::all()
            
        ]);
    }
    protected function createNewToken($token)
    {

        $user=$this->me();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => '60',
            'user'=>$user
        ]);
    }
}
