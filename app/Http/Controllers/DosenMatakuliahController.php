<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\User;
use Illuminate\Http\Request;

class DosenMatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Matakuliah::where('dosen', auth()->user()->name)->get();
        return view('dosen.matakuliah.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Matakuliah $matakuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dosen = User::where('role', 'dosen')->get();
        $data = Matakuliah::findOrFail($id);
        return view('dosen.matakuliah.edit', compact('data', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Matakuliah::findOrFail($id);
        $data->update($request->all());
        $data->save();
        return redirect()->route('matakuliah-dosen.index')->with('toast_success', 'Matakuliah diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matakuliah $matakuliah)
    {
        //
    }
}