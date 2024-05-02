@extends('partials.admin')
@section('title', 'Matakuliah')
@section('content')
    <h3>Data Matakuliah</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('matakuliah.index') }}">Komponen Ujian</a></li>
            <li class="breadcrumb-item active" aria-current="page">Matakuliah</li>
        </ol>
    </nav>
    <div class="card p-3 ">
        <table id="example" class="table table-hover  table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Matakuliah</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Dosen Pengampu</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                    <th>Soal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011-04-25</td>
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
                    <td>
                        <a href="{{ route('soal.index') }}" class="btn btn-primary btn-sm"><i
                                class="fa-solid fa-plus mr-1"></i> Soal</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
