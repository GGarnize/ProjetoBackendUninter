<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $r)
    {
        $data = $r->validate([
            'name'=>'required', 'email'=>'required|email|unique:users',
            'password'=>'required|min:6', 'role'=>'in:ADMIN,MEDICO,ATENDENTE'
        ]);
        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'role'=>$data['role'] ?? 'ATENDENTE',
        ]);
        return response()->json(['token'=>$user->createToken('api')->plainTextToken], 201);
    }

    public function login(Request $r)
    {
        $cred = $r->validate(['email'=>'required|email','password'=>'required']);
        $u = User::where('email',$cred['email'])->first();
        if(!$u || !Hash::check($cred['password'],$u->password)){
            return response()->json(['message'=>'Credenciais inválidas'],401);
        }
        return ['token'=>$u->createToken('api')->plainTextToken];
    }

    public function me(Request $r)
    {
        return $r->user();
    }

    public function logout(Request $r)
    {
        $r->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}


