@extends('partials.admin')
@section('title', 'Soal')
@section('content')
    <h3>Data Soal Matakuliah</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Komponen Ujian</a></li>
            <li class="breadcrumb-item"><a href="{{ route('matakuliah.index') }}">Matakuliah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Soal</li>
        </ol>
    </nav>
    <div class=" mb-3">
        <a href="{{ route('soal.create') }}" class=" btn btn-primary  btn-sm"><i class="fa-solid fa-plus mr-1"></i>Tambah</a>
    </div>
    <div class="card p-3 ">
        <table id="example" class="table table-hover  table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Kunci Jawaban</th>
                    <th>Tingkat Kesulitan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-info btn-sm mr-1"><i class="fa-solid fa-pen mr-1"></i>Edit</a>
                            <form action="#" method="post">
                                @method('delete')
                                @csrf
                                <button type="button" class="btn btn-danger btn-sm"><i
                                        class="fa-solid fa-delete-left mr-1"></i>Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
