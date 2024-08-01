@extends('partials.dosen')
@section('title','Dashboard')
@section('content')
    <div class="pc-content">
        <div class="container mt-5">
            <div class="p-5 bg-light border rounded">
                <h1 class="display-5">Selamat Datang {{ Auth::user()->name }}</h1>
                <p class="lead">Di Platform Ujian Online!</p>
                <hr class="my-4">
                <p>Merupakan platform yang disediakan untuk membantu Anda dalam pelaksanakan ujian.</p>
            </div>
        </div>
       <div class="container">
        <div class="card mt-3">
            <div class="container">
               <div class="card-header"> <h3 class="mt-3">Jadwal Ujian</h3></div>
                <div class="card-body">
                    <table id="example" class="table table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Matakuliah</th>
                                <th>Waktu</th>
                                <th>SKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->matakuliah }}</td>
                                    <td>{{ $item->start }}-{{ $item->end }}</td>
                                    <td>{{ $item->sks }}</td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
           </div>
       </div>
    </div>
@endsection
