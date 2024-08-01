@extends('partials.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="pc-content">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-grd-primary order-card">
                    <div class="card-body">
                        <h6 class="text-white">Jumlah User</h6>
                        <h2 class="text-end text-white"><i class="fa-solid fa-users float-start"></i><span>{{ $user }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-grd-success order-card">
                    <div class="card-body">
                        <h6 class="text-white">Jumlah Matakuliah</h6>
                        <h2 class="text-end text-white"><i class="fa-solid fa-person-chalkboard float-start"></i><span>{{ $matkul }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-grd-warning order-card">
                    <div class="card-body">
                        <h6 class="text-white">Jumlah Soal</h6>
                        <h2 class="text-end text-white"><i class="fa-solid fa-circle-question float-start"></i><span>{{ $soal }}</span>
                        </h2>
                    </div>
                </div>
            </div>


            <!-- Recent Orders end -->
        </div>
    </div>
@endsection
