@extends('partials.dosen')
@section('title', 'Matakuliah')
@section('content')
<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block card mb-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title border-bottom pb-2 mb-2">
                            <h4 class="mb-0">Matakuliah</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="ph ph-house"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Matakuliah</li>
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
                <div class="card-body">
                    <table id="example" class="table table-hover  table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Matakuliah</th>
                                <th>Matakuliah</th>
                                <th>Prodi</th>
                                <th>Semester</th>
                                <th>SKS</th>
                                <th>Dosen Pengampu</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Waktu Pengerjaan</th>
                                <th>Aksi</th>
                                <th>Soal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_matakuliah }}</td>
                                <td>{{ $item->matakuliah }}</td>
                                <td>{{ $item->prodi }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>{{ $item->sks }}</td>
                                <td>{{ $item->dosen }}</td>
                                <td>{{ $item->start }}</td>
                                <td>{{ $item->end }}</td>
                                <td>{{ $item->duration }} <span>Menit</span> </td>
                                <td>
                                    <div class="d-flex  gap-1 justify-content-center">
                                        <a href="{{ route('matakuliah.edit',$item->id) }}" class="btn btn-info btn-sm mr-1" title="Edit"><i class="fa-solid fa-pen mr-1"></i></a>
                                        <form action="{{ route('matakuliah.destroy',$item->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i
                                                    class="fa-solid fa-delete-left mr-1"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ url('soal-dosen/'.$item->id) }}" class="btn btn-primary btn-sm"><i
                                            class="fa-solid fa-plus mr-1"></i> Soal</a>
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
