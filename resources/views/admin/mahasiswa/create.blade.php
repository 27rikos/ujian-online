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
                                <h4 class="mb-0">Data Mahasiswa</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.index') }}"><i
                                            class="ph ph-house"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Tambah Data Mahasiswa</li>
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
                        <form action="{{ route('mahasiswa.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nama" class="mb-2">Nama Mahasiswa</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="nim" class="mb-2">NPM</label>
                                <input type="text" class="form-control" name="nim">
                            </div>
                            <div class="form-group">
                                <label for="email" class="mb-2">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="mb-2">No HP</label>
                                <input type="string" class="form-control" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="password" class="mb-2">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection
