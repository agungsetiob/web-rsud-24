<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TokenController extends Controller
{
    public function index()
    {
        $title = 'Generate Token';
        $tokens = \Laravel\Sanctum\PersonalAccessToken::with('tokenable')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('tokens.index', compact('tokens'));

    }
    public function generate(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Anda tidak memiliki akses pembuatan token'], 403);
        }
        $request->validate([
            'user_id' => 'required',
            'token_name' => 'required|string|max:255|unique:personal_access_tokens,name',
        ]);

        $user = User::where('id', $request->user_id)
            ->orWhere('email', $request->user_id)
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        $token = $user->createToken($request->token_name)->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }

    /**
     * Revoke a specific token for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function revoke(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Anda tidak memiliki akses revoke token'], 403);
        }
        $request->validate([
            'user_id' => 'required',
            'token_name' => 'required|string|max:255',
        ]);

        $user = User::where('id', $request->user_id)
            ->orWhere('email', $request->user_id)
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        $tokens = $user->tokens()->where('name', $request->token_name)->get();

        if ($tokens->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak ditemukan.'
            ], 404);
        }

        foreach ($tokens as $token) {
            $token->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Token berhasil dicabut.'
        ]);
    }
}