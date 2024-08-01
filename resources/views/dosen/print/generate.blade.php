<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 30px;
        }
        .kop-surat img {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
        .kop-surat h1 {
            font-size: 24px;
            margin: 0;
        }
        .kop-surat p {
            margin: 0;
            font-size: 14px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <h1>UNIVERSITAS METHODIST INDONESIA</h1>
        <p>Alamat: Jl. Hang Tuah No.8, Madras Hulu, Kec. Medan Polonia, Kota Medan, Sumatera Utara 20151</p>
        <p>Telepon: 0614157882 | Email: https://www.methodist.ac.id</p>
        <hr class="border border-dark border-2 opacity-50">
    </div>

    <div class="table-container">
        <table  class="mb-3">
            <tr>
                <td colspan="2">Program Studi</td>
                <td><span class="mx-2">:</span></td>
                <td>{{ $matkul->prodi }}</td>
            </tr>
            <tr>
                <td colspan="2">Matakuliah/SKS</td>
                <td><span class="mx-2">:</span></td>
                <td>{{ $matkul->matakuliah }}/{{ $matkul->sks }}</td>
            </tr>
            <tr>
                <td colspan="2">Dosen</td>
                <td><span class="mx-2">:</span></td>
                <td>{{ $matkul->dosen }}</td>
            </tr>
            <tr>
                <td colspan="2">Waktu Pengerjaan</td>
                <td><span class="mx-2">:</span></td>
                <td>{{ $matkul->duration }} Menit</td>
            </tr>
            <tr>
                <td colspan="2">Semester</td>
                <td><span class="mx-2">:</span></td>
                <td>Semester {{ $matkul->semester }}</td>
            </tr>
        </table>
        <table id="example" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NPM</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>NA</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
