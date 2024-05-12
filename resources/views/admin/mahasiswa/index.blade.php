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
                                <h4 class="mb-0">Data Alumni</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="ph ph-house"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Alumni</li>
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
                            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Peminatan</th>
                                    <th>Stambuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger</td>
                                    <td>Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011-04-25</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm" title="Edit"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-info btn-sm" title="Detail"><i
                                                class="fa-solid fa-circle-info"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" title="Hapus"><i
                                                class="fa-solid fa-delete-left"></i></a>
                                    </td>
                                </tr>
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
