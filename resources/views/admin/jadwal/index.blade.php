@extends('partials.admin')
@section('title', 'Mahasiswa')
@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block card mb-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title border-bottom pb-2 mb-2">
                                <h4 class="mb-0">Data Jadwal</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="ph ph-house"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Jadwal Ujian</li>
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
                            <a href="{{ route('jadwal.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Matakuliah</th>
                                    <th>Waktu</th>
                                    <th>SKS</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->matakuliah }}</td>
                                        <td>{{ $item->start }}-{{ $item->end }}</td>
                                        <td>{{ $item->sks }}</td>
                                        </td>
                                        <td class="d-flex gap-1">
                                            <a href="{{ route('jadwal.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm" title="Edit"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <form action="{{ route('jadwal.destroy', $item->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="submit"><i
                                                        class="fa-solid fa-delete-left "></i></button>
                                            </form>
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