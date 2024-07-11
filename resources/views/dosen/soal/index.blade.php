@extends('partials.dosen')
@section('title', 'Soal')
@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block card mb-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title border-bottom pb-2 mb-2">
                                <h4 class="mb-0">Soal</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="ph ph-house"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Matakuliah</li>
                                <li class="breadcrumb-item" aria-current="page">{{ $matakuliah->matakuliah }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <a href="{{ url('soal-dosen/create/'.$matakuliah->id) }}" class="btn btn-primary btn-sm">Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-hover  table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pertanyaan</th>
                                    <th>Tingkat Kesulitan</th>
                                    <th>Kunci Jawaban</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!! $item->soal !!}</td>
                                    <td>{{ $item->kesulitan }}</td>
                                    <td>{{ $item->kunci }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ url("soal-dosen/{$item->id}/edit/{$matakuliah->id}") }}" class="btn btn-info btn-sm me-1" title="Edit"><i class="fa-solid fa-pen mr-1"></i></a>
                                            <form action="{{ url("soal-dosen/{$item->id}/delete/{$matakuliah->id}") }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i
                                                        class="fa-solid fa-delete-left mr-1"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection
