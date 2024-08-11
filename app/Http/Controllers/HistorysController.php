<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Matakuliah;

class HistorysController extends Controller
{
    public function index()
    {
        $data = Matakuliah::all();
        return view('admin.history.index', compact('data'));
    }
    public function show($id)
    {
        $history = History::where('id_matkul', $id)->get();
        $data = Matakuliah::value('matakuliah');
        return view('admin.history.history', compact('data', 'history', 'id'));
    }

    public function destroy($id, $id_matakuliah)
    {
        $data = History::findOrFail($id);
        $data->delete();

        return redirect('show-jawaban/' . $id_matakuliah)->with('toast_success', 'History jawaban dihapus');
    }
}