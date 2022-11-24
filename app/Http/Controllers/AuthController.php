<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['login']
        ]);
    }

    /**
     * Get a JWT via given credentials.
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Post(
     *      path="/api/auth/login",
     *      summary="",
     *      operationId="auth.login",
     *      tags={"auth"},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="email", type="string"),
     *                  @OA\Property(property="password", type="string"),
     *                  example={"email": "root@grr.la", "password": "root"}
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description=""
     *      )
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     * Get the authenticated User.
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Post(
     *      path="/api/auth/me",
     *      summary="",
     *      operationId="auth.me",
     *      tags={"auth"},
     *      security={{ "bearer_token": {} }},
     *      @OA\Response(response=200, description="")
     * )
     */
    public function me()
    {
        return response()->json(auth()->user());
    }


    /**
     * Log the user out (Invalidate the token).
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Post(
     *      path="/api/auth/logout",
     *      summary="",
     *      operationId="auth.logout",
     *      tags={"auth"},
     *      security={{ "bearer_token": {} }},
     *      @OA\Response(response=200, description="")
     * )
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    
    /**
     * Refresh a token.
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Post(
     *      path="/api/auth/refresh",
     *      summary="",
     *      operationId="auth.refresh",
     *      tags={"auth"},
     *      security={{ "bearer_token": {} }},
     *      @OA\Response(response=200, description="")
     * )
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
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }
}