@extends('partials.dosen')
@section('title', 'Nilai Ujian')
@section('content')
<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block card mb-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title border-bottom pb-2 mb-2">
                            <h4 class="mb-0">Nilai Ujian</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('matakuliah.index') }}"><i
                                        class="ph ph-house"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Update Nilai Ujian</li>
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
                    <form action="{{ url("dosen-show-nilai/{$id}/update/{$find->id}") }}" method="post" >
                    @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="tugas">Nilai Tugas</label>
                            <input type="number" class="form-control" name="tugas" id="tugas" value="{{ $find->tugas }}">
                        </div>
                        <div class="form-group">
                            <label for="uts">Nilai UTS</label>
                            <input type="number" class="form-control" readonly name="uts" id="uts" value="{{ $find->uts }}">
                        </div>
                        <div class="form-group">
                            <label for="uas">Nilai UTS</label>
                            <input type="number" class="form-control" readonly name="uas" id="uas" value="{{ $find->uas }}">
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
