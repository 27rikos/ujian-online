@extends('partials.admin')
@section('content')
<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block card mb-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title border-bottom pb-2 mb-2">
                            <h4 class="mb-0">Data jadwal</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.index') }}"><i
                                        class="ph ph-house"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Tambah Jadwal</li>
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
                    <form action="{{ route('jadwal.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal" class="mb-2">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal">
                        </div>
                        <div class="form-group">
                            <label for="matakuliah" class="mb-2">Matakuliah</label>
                           <select name="matakuliah" id="matakuliah" class="form-control">
                            <option value="" disabled>Pilih Matakuliah</option>
                            @foreach ($matakuliah as $item)
                                <option value="{{ $item->matakuliah }}">{{ $item->matakuliah }}</option>
                            @endforeach
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="email" class="mb-2">Waktu Ujian</label>
                           <div class="row">
                            <div class="col-md-5">
                                <input type="time" class="form-control" name="start">
                            </div>
                            <div class="col-md-2 text-center mt-2">Sampai</div>
                            <div class="col-md-5">
                                <input type="time" class="form-control" name="end">
                            </div>
                           </div>
                        </div>
                        <div class="form-group">
                            <label for="sks" class="mb-2">SKS</label>
                            <input type="text" class="form-control" name="sks">
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
