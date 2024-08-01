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
                            <h4 class="mb-0">Data Soal</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('matakuliah.index') }}"><i
                                        class="ph ph-house"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Tambah Soal</li>
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
                    <form action="{{ url("soal-dosen/{$find->id}/update/{$id}") }}" method="post" >
                    @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="x">Soal</label>
                            <input id="x" type="hidden" name="soal" value="{!! $find->soal !!}">
                            <trix-editor input="x"></trix-editor>
                        </div>
                        <div class="form-group">
                            <label for="jenis_ujian" class="mb-2">Jenis Ujian</label>
                            <select name="jenis_ujian" id="jenis_ujian" class="form-control" value="{{ $find->jenis_ujian }}">
                                <option value="">Pilih</option>
                                @foreach (['UTS', 'UAS',] as $option)
                                <option value="{{ $option }}"
                                    {{ $find->jenis_ujian == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kesulitan">Tingkat Kesulitan</label>
                            <select name="kesulitan" id="kesulitan" class="form-control" value="{{ $find->kesulitan }}">
                                <option value="">Pilih</option>
                                @foreach (['Mudah','Sedang','Sulit'] as $option)
                                    <option value="{{ $option }}"
                                        {{ $find->kesulitan == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kunci">Kunci Jawaban</label>
                            <textarea name="kunci" id="kunci" cols="30" rows="5" class="form-control">{{ $find->kunci }}</textarea>
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

@push('trix-soal')
    <script src="{{ asset('trix/trix.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('trix/trix.css') }}">
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
@endpush
