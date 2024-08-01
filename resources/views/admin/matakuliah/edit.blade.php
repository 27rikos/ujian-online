@extends('partials.admin')
@section('title','Matakuliah')
@section('content')
<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block card mb-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title border-bottom pb-2 mb-2">
                            <h4 class="mb-0">Data Matakuliah</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('matakuliah.index') }}"><i
                                        class="ph ph-house"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit Matakuliah</li>
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
                    <form action="{{ route('matakuliah.update',$data->id) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="kode_matakuliah" class="mb-2">Kode Matakuliah</label>
                            <input type="text" class="form-control" id="kode_matakuliah" name="kode_matakuliah" value="{{ $data->kode_matakuliah }}">
                        </div>
                        <div class="form-group">
                            <label for="matakuliah" class="mb-2">Matakuliah</label>
                            <input type="text" class="form-control" id="matakuliah" name="matakuliah" value="{{ $data->matakuliah }}">
                        </div>
                        <div class="form-group">
                            <label for="prodi" class="mb-2">Program Studi</label>
                            <select name="prodi" id="prodi" class="form-control" value="{{ $data->prodi }}">
                                <option value="">Pilih Program Studi</option>
                                @foreach (['TI', 'SI', 'PTI',] as $option)
                                    <option value="{{ $option }}"
                                        {{ $data->prodi == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester" class="mb-2">Semester</label>
                            <select name="semester" id="semester" class="form-control" value="{{ $data->semester }}">
                                <option value="">Pilih Semester</option>
                                @foreach (['1', '2', '3', '4','5','6','7',8] as $option)
                                    <option value="{{ $option }}"
                                        {{ $data->semester == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sks" class="mb-2">SKS</label>
                            <input type="text" class="form-control" id="sks" name="sks" value="{{ $data->sks }}">
                        </div>
                        <div class="form-group">
                            <label for="dosen" class="mb-2">Dosen</label>
                            <select name="dosen" id="dosen" class="form-control">
                                <option value="">Pilih Dosen</option>
                                @foreach ($dosen as $item)
                                    <option value="{{ $item->name }}" {{ $item->name==$data->dosen ? 'selected':'' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="duration" class="mb-2">Durasi Ujian <span class="ms-1">(Menit)</span></label>
                            <input type="number" class="form-control" id="duration" name="duration" value="{{ $data->duration }}">
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
