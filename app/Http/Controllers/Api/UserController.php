<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 1. Register user baru (tanpa auth)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $user = User::create([
            'name' => $request->name,
            'exp' => 0,
            'level' => 1,
        ]);

        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'exp' => $user->exp,
            'level' => $user->level,
        ], 201);
    }

    // 2. Ambil data user
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'exp' => $user->exp,
            'level' => $user->level,
        ]);
    }

    // 3. Tambah EXP
    public function updateExp(Request $request, $id)
    {
        $request->validate([
            'exp_gained' => 'required|integer|min:1',
        ]);

        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->exp += $request->exp_gained;
        $user->save(); // level otomatis update lewat mutator

        return response()->json([
            'user_id' => $user->id,
            'exp' => $user->exp,
            'level' => $user->level,
        ]);
    }
}