@extends('partials.admin')
@section('title', 'Soal')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Komponen Ujian</a></li>
            <li class="breadcrumb-item"><a href="{{ route('matakuliah.index') }}">Matakuliah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Soal</li>
        </ol>
    </nav>
    <div class="card shadow mb-4 my-2 my-3">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Tambah Soal
            </h6>
            <a href="{{ route('soal.index') }}" class="btn btn-primary btn-icon-split btn-sm  ml-auto ">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('soal.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="x">Soal</label>
                    <input id="x" type="hidden" name="konten">
                    <trix-editor input="x"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="judul">Tingkat Kesulitan</label>
                    <select name="kesulitan" id="" class="form-control">
                        <option value="">Pilih</option>
                        <option value="">Mudah</option>
                        <option value="">Sedang</option>
                        <option value="">Sulit</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="penulis">Kunci Jawaban</label>
                    <textarea name="kunci" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('trix-soal')
    <script src="{{ asset('trix/trix.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('trix/trix.css') }}">
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
@endpush
