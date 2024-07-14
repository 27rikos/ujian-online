@extends('partials.mahasiswa')
@section('content')
<div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block card mb-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title border-bottom pb-2 mb-2">
                            <h4 class="mb-0">{{ $matakuliah->matakuliah }}</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="list-unstyled">
                            <li>Dosen Pengampu : {{ $matakuliah->dosen }}</li>
                            <li>SKS : {{ $matakuliah->sks }}</li>
                            <li>Waktu Pengerjaan : {{ $matakuliah->duration }} Menit</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
<div class="card mt-5">
    <div class="my-3 mx-3 text-center">
        <p class="fw-bold">
            Durasi Waktu Pengerjaan Soal:
        </p>
        <h6 id="duration" class="text-danger">{{ $matakuliah->duration }}</h6>
    </div>
</div>
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form id="" action="{{ url('simpan-jawaban/'.$matakuliah->id.'/uas') }}" method="post">
                    @csrf
                    @foreach ($data as $item)
                        <div class="d-flex mb-2">
                            <p class="mb-0 mx-2">{{ $loop->iteration }}</p>
                            <p class="mb-0">{!! $item->soal !!}</p>
                        </div>
                       <div class="my-2">
                        <p class="fw-bold ms-3">Jawaban :</p>
                        <textarea name="jawaban{{ $loop->iteration }}" id="jawaban{{ $loop->iteration }}" cols="30" rows="5" class="form-control"></textarea>
                       </div>
                    @endforeach
                <button class="btn btn-primary" type="submit" id="submitBtn">Simpan</button>
                </form>
                </div>

            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var durationElement = document.getElementById('duration');
        if (!durationElement || durationElement.textContent.trim() === '') {
            console.error('Duration element not found or empty.');
            return;
        }

        var durationText = durationElement.textContent.trim();

        // Check if durationText is null or undefined
        if (durationText === 'null' || durationText === 'undefined') {
            console.error('Duration value is null or undefined.');
            return;
        }

        // Konversi durasi dari menit ke detik
        var totalSeconds = parseInt(durationText) * 60;

        if (totalSeconds > 0) {
            startCountdown(totalSeconds);
        } else {
            durationElement.textContent = "Waktu Habis!";
        }

        function startCountdown(duration) {
            var timer = duration;
            var countdownInterval = setInterval(function () {
                var hours = Math.floor(timer / 3600);
                var minutes = Math.floor((timer % 3600) / 60);
                var seconds = Math.floor(timer % 60);

                var formattedHours = hours < 10 ? "0" + hours : hours;
                var formattedMinutes = minutes < 10 ? "0" + minutes : minutes;
                var formattedSeconds = seconds < 10 ? "0" + seconds : seconds;

                durationElement.textContent = formattedHours + ":" + formattedMinutes + ":" + formattedSeconds;

                if (--timer < 0) {
                    clearInterval(countdownInterval);
                    durationElement.textContent = "Waktu Habis!";
                    // Auto-click button ketika waktu habis
                    document.getElementById('submitBtn').click();
                }
            }, 1000);
        }
    });
</script>


@endsection
