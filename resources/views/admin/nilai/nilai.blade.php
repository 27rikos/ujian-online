@extends('partials.admin')
@section('title','Nilai Ujian')
@section('content')
<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block card mb-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title border-bottom pb-2 mb-2">
                            <h4 class="mb-0">Nilai Matakuliah</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="ph ph-house"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Nilai</li>
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
                    <a href="{{ url('generate-pdf/'.$id) }}"class="btn btn-danger btn-sm"><i class="fa-solid fa-file-pdf me-1"></i>Export PDF</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-hover table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Matakuliah</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Tugas</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Nilai Akhir</th>
                                <th>Grade</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->matkul->matakuliah }}</td>
                                <td>{{ $item->nama_mahasiswa }}</td>
                                <td>{{ $item->npm }}</td>
                                <td>{{ $item->tugas }}</td>
                                <td>{{ $item->uts }}</td>
                                <td>{{ $item->uas }}</td>
                                <td>{{ $nilaiAkhir = number_format((2 * $item->tugas + 3 * $item->uts + 5 * $item->uas) / 10, 2) }}</td>
                                <td>
                                    @if ($nilaiAkhir >= 85)
                                        A
                                    @elseif ($nilaiAkhir >= 80)
                                        A-
                                    @elseif ($nilaiAkhir >= 75)
                                        B+
                                    @elseif ($nilaiAkhir >= 70)
                                        B
                                    @elseif ($nilaiAkhir >= 65)
                                        B-
                                    @elseif ($nilaiAkhir >= 60)
                                        C+
                                    @elseif ($nilaiAkhir >= 55)
                                        C
                                    @elseif ($nilaiAkhir >= 50)
                                        C-
                                    @elseif ($nilaiAkhir >= 45)
                                        D+
                                    @elseif ($nilaiAkhir >= 40)
                                        D
                                    @else
                                        F
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url("show-nilai/{$id}/edit/{$item->id}") }}" class="btn btn-primary btn-sm">Update Nilai</a>
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
