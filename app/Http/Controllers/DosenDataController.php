<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DosenDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::latest()->where('role', 'dosen')->get();
        return view('admin.dosen.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'nim' => 'required|unique:users',
                'email' => 'required|unique:users',
                'phone' => 'required',
                'password' => 'required'
            ],
            messages: [
                'nim.unique' => 'NIM sudah digunakan',
                'email.unique' => 'Email sudah digunakan'
            ]
        );
        $role = 'dosen';
        // Hashing password
        $hashedPassword = Hash::make($request->password);
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'remember_token' => Str::random(60),
            'role' => $role,
            'phone' => $request->phone,
            'nim' => $request->nim,
        ]);
        $data->save();
        return redirect()->route('Dosen.index')->with('toast_success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.dosen.edit', compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'nim' => $request->nim,
        ]);
        $data->save();
        return redirect()->route('Dosen.index')->with('toast_success', 'Data Berhasil Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('Dosen.index')->with('toast_success', 'Data Berhasil Hapus');
    }
}
