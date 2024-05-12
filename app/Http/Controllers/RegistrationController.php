<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('login.register');
    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);
        // Hashing password
        $hashedPassword = Hash::make($request->password);
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'remember_token' => Str::random(60),
            'phone' => $request->phone,
            'nim' => $request->nim,
        ]);
        $data->save();
        return redirect()->route('login')->with('toast_success', 'Berhasil Registrasi');
    }
}
